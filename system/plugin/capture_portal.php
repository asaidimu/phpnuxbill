<?php
register_menu("Capture Portal", true, "create_portal", "AFTER_SETTINGS", "ion ion-wifi  ");
$SETTING_HOTSPOT_NAME = "hotspot_name";
$SETTING_HOTSPOT_DESC = "hotspot_description";

function create_portal()
{
  global $ui;
  global $SETTING_HOTSPOT_NAME;
  global $SETTING_HOTSPOT_DESC;
  _admin();

  $ui->assign("_title", "Create Capture Portal");
  $ui->assign("_system_menu", "Settings");
  $admin = Admin::_info();
  $ui->assign("_admin", $admin);
  $routers = ORM::for_table('tbl_routers')->find_many();
  $ui->assign("routers", $routers);

  foreach (array(["title", $SETTING_HOTSPOT_NAME], ["description", $SETTING_HOTSPOT_DESC]) as [$label, $name]) {
    $row = ORM::for_table("tbl_appconfig")->where("setting", $name)->find_one();
    if ($row) {
      $ui->assign($label, $row->value);
    }
  }

  $ui->display("capture_portal.tpl");
}

function generate_portal()
{
  $title = _post("title");
  $description = _post("description");
  $router_name = _post("router");

  $router = ORM::for_table("tbl_routers")->where("name", $router_name)->find_one();
  $plans = ORM::for_table("tbl_plans")->where("type", "Hotspot")->where("routers", $router_name)->find_many();

  if (empty($router) || empty($plans)) {
    $message = json_encode(["status" => "error", "message" => "Unable to process your request, please refresh the page", "router" => $router]);
    echo $message;
    exit();
  }

  $router_id = $router["id"];
  $plan_data = array();
  foreach ($plans as $plan) {
    $bw = ORM::for_table("tbl_bandwidth")->where("id", $plan["id_bw"])->find_one();
    array_push($plan_data, array(
      "id" => $plan["id"],
      "name" => $plan["name_plan"],
      "router" => $router["id"],
      "price" => array(
        "unit" => "KES",
        "value" => $plan["price"]
      ),
      "bandwidth" => array(
        "up" => array(
          "unit" => $bw["rate_up_unit"],
          "value" => $bw["rate_up"]
        ),
        "down" => array(
          "unit" => $bw["rate_down_unit"],
          "value" => $bw["rate_down"]
        )
      ),
      "limit" => array(
        "type" => $plan["typebp"],
        "data" => array(
          "unit" => $plan["data_unit"],
          "value" => $plan["data_limit"]
        ),
        "time" => array(
          "unit" => $plan["time_unit"],
          "value" => $plan["time_limit"]
        ),
        "validity" => array(
          "unit" => $plan["validity_unit"],
          "value" => $plan["validity"]
        )
      )
    ));
  }
  $cwd = getcwd();

  $data = array(
    "plans" => $plan_data,
    "title" => $title,
    "description" =>  $description,
    "baseURL" =>  APP_URL,
    "router" => $router_id,
    // "key" => $key->value
  );

  $filename = "config.json";
  $out = $cwd . DIRECTORY_SEPARATOR . "system" . DIRECTORY_SEPARATOR . "plugin" . DIRECTORY_SEPARATOR . "capture_portal" . DIRECTORY_SEPARATOR . "site" . DIRECTORY_SEPARATOR .  $filename;
  $config = json_encode($data, JSON_UNESCAPED_SLASHES);

  // write out the config
  file_put_contents($out, $config);
  $site = $cwd . DIRECTORY_SEPARATOR . "system" . DIRECTORY_SEPARATOR . "plugin" . DIRECTORY_SEPARATOR . "capture_portal" . DIRECTORY_SEPARATOR . "site";
  $cache_dir = $cwd . DIRECTORY_SEPARATOR . "system" . DIRECTORY_SEPARATOR . "plugin" . DIRECTORY_SEPARATOR . "capture_portal" . DIRECTORY_SEPARATOR . "cache";
  $portal = $cache_dir . DIRECTORY_SEPARATOR . "site.zip";

  // zip directory
  if (!is_dir($cache_dir)) {
    mkdir($cache_dir, 0777, true);
  }

  zipDirectory($site, $portal);
  $output = file_get_contents($portal);

  // Send headers to force download
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename=' . basename($portal));
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . strlen($output));

  echo $output;
  exit();
}

function zipDirectory($source, $destination)
{
  if (!extension_loaded('zip') || !file_exists($source)) {
    return false;
  }

  $zip = new ZipArchive();
  if (!$zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
    return false;
  }

  $source = realpath($source);
  if (is_dir($source)) {
    $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($source),
      RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $file) {
      if (!$file->isDir()) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($source) + 1);
        $zip->addFile($filePath, $relativePath);
      }
    }
  } elseif (is_file($source)) {
    $zip->addFile($source, basename($source));
  }

  return $zip->close();
}

function generateRandomString($length = 8)
{
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $index = array_rand(str_split($characters));
    $randomString .= $characters[$index];
  }
  return $randomString;
}
