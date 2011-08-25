<?php
/**
 * sfValidatedFile $file
 */

$name = $file->getOriginalName();
$ext = substr($file->getOriginalExtension(), 1);
?>

<a href="/uploads/<?php echo $name; ?>" rel="<?php echo $name; ?>" class="redactor_file_link redactor_file_ico_<?php echo $ext; ?>"><?php echo $name; ?></a>