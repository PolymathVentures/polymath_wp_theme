<?php
$JB_URL = "https://api.greenhouse.io/v1/boards/polymathventures";
$HV_URL = "https://harvest.greenhouse.io/v1";
$HV_TKN = "dae0b039e8d803e0ff1ccf222fbab861-1";

function greenhouse_jobs() {
  global $JB_URL, $HV_URL, $HV_TKN;
  $curl = curl_init( $JB_URL."/jobs?content=true" );
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
  $resp = curl_exec( $curl ); curl_close( $curl );
  $jobs = json_decode($resp, true)["jobs"];

  usort($jobs, function($a, $b) {
    if( $a["offices"][0]["name"]==$b["offices"][0]["name"] )
      return strcmp($a["title"], $b["title"]);
    if( $a["offices"][0]["name"]=="Polymath" )
      return -1;
    if( $b["offices"][0]["name"]=="Polymath" )
      return 1;
    return strcmp($a["offices"][0]["name"], $b["offices"][0]["name"]);
  });

  return $jobs;
}

function get_greenhouse_venture_map( $ventures ) {
  $keys   = array_map(function($venture) { return $venture->post_title; }, $ventures->posts);
  $values = array_map(function($venture) { return $venture->ID; }, $ventures->posts);

  return array_combine($keys, $values);
}

function get_greenhouse_expertise( $jobs ) {
  $keys   = array_map(function($job) { return $job["departments"][0]["id"]; }, $jobs);
  $values = array_map(function($job) { return $job["departments"][0]["name"]; }, $jobs);

  return array_combine($keys, $values);
}

function get_greenhouse_job( $id ) {
  $jobs = greenhouse_jobs();
  foreach( $jobs as $job ) {
    if( $job["id"]==$id ) {
      return $job;
    }
  }
}

function get_greenhouse_form( $id ) {
  global $JB_URL, $HV_URL, $HV_TKN;

  // GET JOB INTERNAL ID
  $curl = curl_init( $JB_URL."/jobs/".$id );
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $resp  = curl_exec( $curl ); curl_close( $curl );
  
  $jobid = json_decode($resp, true)["internal_job_id"];

  // GET JOB FORM QUESTIONS
  $curl = curl_init( $HV_URL."/jobs/".$jobid."/job_posts");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_USERPWD, $HV_TKN.":");
  $resp  = curl_exec( $curl ); curl_close( $curl );

  return json_decode($resp, true)[0]["questions"];
}

function greenhouse_rewrite_templates() {
  $job = get_greenhouse_job( get_query_var('job_id') );
  if( get_query_var('job_id') ) {
    $template = $job ? '/templates/content-single-job.php' : '/404.php';

    add_filter('template_include', function() use ($template) {
      return get_template_directory().$template;
    });
  }
}

add_action('template_redirect', 'greenhouse_rewrite_templates');
