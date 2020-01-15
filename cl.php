<?php 

$db_server = 'localhost'; 
$db_user="xemlacotvbf32"; 
$db_password="7fdaae1369f45bf7"; 
$db_name = "xemlaco_tv_bf32"; 

// Cac table can convert 
$table_names = array("tb_film_other", "tb_film");  

// Ket noi CSDL 
mysql_connect($db_server, $db_user, $db_password) or die(mysql_error()); 
mysql_select_db($db_name); 
// Thuc hien 
charset_fixer($table_names); 

function charset_fixer($table_names){ 
  foreach($table_names as $type){ 
    $ret[] = charset_fixer_fix_table($type); 
  } 
} 

function charset_fixer_fix_table($table) { 
  $ret = array(); 
  $types = array('char' => 'binary', 
                 'varchar' => 'varbinary', 
                 'tinytext' => 'tinyblob', 
                 'text' => 'blob', 
                 'mediumtext' => 'mediumblob', 
                 'longtext' => 'longblob'); 

  // du table tiep theo vao list 
  $convert_to_binary = array(); 
  $convert_to_latin1 = array(); 
  $convert_to_utf8 = array(); 

  // thuc hien convert 
  $result = mysql_query('SHOW FULL COLUMNS FROM '. $table .''); 
  while ($column = mysql_fetch_assoc($result)) { 
    list($type) = explode('(', $column['Type']); 
    if (isset($types[$type])) { 
      $names = 'CHANGE `'. $column['Field'] .'` `'. $column['Field'] .'` '; 
      $attributes = ' DEFAULT '. ($column['Default'] == 'NULL' ? 'NULL ' : 
                     "'". mysql_real_escape_string($column['Default']) ."' ") . 
                    ($column['Null'] == 'YES' ? 'NULL' : 'NOT NULL'); 
      $convert_to_binary[] = $names . preg_replace('/'. $type .'/i', $types[$type], $column['Type']) . $attributes; 
      $convert_to_latin1[] = $names . $column['Type'] .' CHARACTER SET latin1'. $attributes; 
      $convert_to_utf8[] = $names . $column['Type'] .' CHARACTER SET utf8'. $attributes; 
    } 
  } 

  if (count($convert_to_binary)) { 
    //dat collatoin table mac dinh thanh latin1 
    mysql_query('ALTER TABLE '. $table .' DEFAULT CHARACTER SET latin1'); 

    //Convert sang latin1 
    mysql_query('ALTER TABLE '. $table .' '. implode(', ', $convert_to_latin1)); 
     
   //dat collatoin table mac dinh thanh utf8 
    mysql_query('ALTER TABLE '. $table .' DEFAULT CHARACTER SET utf8'); 
     
    //Convert latin1 sang binary 
    mysql_query('ALTER TABLE '. $table .' '. implode(', ', $convert_to_binary)); 
     
    //Convert binary sang UTF-8 
    mysql_query('ALTER TABLE '. $table .' '. implode(', ', $convert_to_utf8)); 
  } 
} 
?> 
Convert thanh cong!