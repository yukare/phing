<?php

require_once "phing/Task.php";

class UpdateFilesTask extends Task {

  /**
   * @var string Directory with your the files.
   */
  private $source = null;

  /**
   * @var string Directories to sync to.
   */
  private $destination = null;

  /**
   * @var string The operation todo.
   * - import: Copy the files that already exist in source(and only they)
   *            from destination replacing the current in source.
   * - export: Copy the files from source to destination, overwriting they.
   */
  private $operation = null;

  /**
   * The setter for the attribute "source"
   */
  public function setSource($str) {
    $this->source = $str;
  }

  /**
   * The setter for the attribute "destination"
   */
  public function setDestination($str) {
    $this->destination = $str;
  }

  /**
   * The setter for the attribute "operation"
   */
  public function setOperation($str) {
    $this->operation = $str;
  }

  /**
   * The init method: Do init steps.
   */
  public function init() {
    // nothing to do here
  }

  /**
   * The main entry point method.
   */
  public function main() {
    echo("\nsource: " . $this->source);
    echo("\ndestination: " . $this->destination);
    echo("\noperation: " . $this->operation);
    $files = $this->listFiles($this->source);
    print_r($files);
    if(!is_dir($this->destination)) {
      mkdir($this->destination);
    }
    foreach($files as $file) {
      if($this->operation == 'export') {
        copy($file, $this->destination . '/' . basename($file));
      }
      elseif($this->operation == 'import') {
        copy($this->destination . '/' . basename($file), $file);
      }
    }
  }

  protected function listFiles($path) {
    $files = array();
    if (is_file($path)) {
      $files[] = $path;
    }
    elseif (is_dir($path)) {
      $all_files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
      foreach ($all_files as $file) {
        /** @var \SplFileInfo $file */
        if (basename($file->getPathname()) != '.' && basename($file->getPathname()) != '..') {
          $files[] = $file->getPathname();
        }
      }
    }
    return $files;
  }
}

?>