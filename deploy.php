<?php
// request_path() is defined at the bottom
$path = '/' . request_path();

// Edit this string to reflect on the default location of vhost web roots
// do include the trailing slash
// Example: $default_parent_path = '/var/www/vhosts/';
$default_parent_path = '/var/www/vhosts/';

// The name of the public_html directory
// do include the leading slash
// do not include the trailing slash
// Example: $default_public_directory = '/public';
$default_public_directory = '/public';

// Specify which branch by appending a branch name variable 'bn' to the end of the url
// defaults to 'master' if none specified
// Example: <a href="http://post-receive.mysrv.com/mywebsite.mysrv.com?bn=develop
">http://post-receive.mysrv.com/mywebsite.mysrv.com?bn=develop
</a>$default_pull_branch_name = 'master';
if (empty($_GET['bn'])) {
  $pull_branch_name = $default_pull_branch_name;
}
else {
  $pull_branch_name = $_GET['bn'];
}

// The idea is if only 1 argument is present, treat that as the /var/www/vhosts/<directory_name>
// and if more than 1 argument is given, treat that as the full "cd-able" path
$args = explode('/', $path);

if (count($args) === 1) {
  $working_path = $default_parent_path . $path . $default_public_directory;
}
elseif (count($args) > 1) {
  $working_path = ‘/’ . $path;
}

// Do the routine only if the path is good.
// Assumes that origin has already been defined as a remote location.
// We reset the head in order to make it possible to switch to a branch that is behind the latest commits.
if (!empty($working_path) && file_exists($working_path)) {
  $output = shell_exec("cd $working_path; git fetch origin; git reset —hard; git checkout $pull_branch_name; git pull origin $pull_branch_name);
echo "<pre>$output</pre>";
}

 /**
 * Returns the requested url path of the page being viewed.
 *
 * Example:
 * – <a href="http://example.com/node/306">http://example.com/node/306</a> returns "node/306".
 * 
 * See request_path() in Drupal 7 core api for more details 
 */
function request_path() {
  …
}
