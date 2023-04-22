<?php
class Database 
{
	
   private $conn;
	private $connStr;
	private $query;
	private $result,$result1,$result2;
	private $rand_key = 'SBnkckZwQopPyJHFz';          // Database
	
	public static $host = 'localhost';
    public static $user = 'store_kare';
    public static $pass = 'n[nPI2[_&rcP';
    public static $dbname = 'kare_store';

	
	public function connect()
	{
	
	   try
	   { 
	       $this->conn = new PDO('mysql:host='.self::$host.'; dbname='.self::$dbname, self::$user, self::$pass);
         //  $this->conn = new PDO( "mysql:host=localhost; dbname=atvstore", "root", "");  // local DB
		 // $this->conn = new PDO( "mysql:host=localhost; dbname=kare_store", "store_kare", "n[nPI2[_&rcP");  // live DB
        // $this->conn = new PDO( "sqlsrv:server=IPADDRESS; Database=klustore", "root", "");
		  if(!$this->conn) 
		{
		 return false;
		}
		else
		{
		 return true;
		}
		
		}
		catch (Exception $e) 
		{
		//return  $e->getMessage();
                return false;
        }

	
	
	}
	

	public function getloginvar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
	
	public function query($q)
    {
		$stmt = $this->conn->prepare($q);
		//print_r($stmt);
		//exit;
		$stmt->execute();
		return $stmt;
	}
	function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B%^&#54567890dfuighdfjkg893468989djkf(^*(^&*$%@(_)_+#%$@@#~!@~!@@`1212343463C27'; // user define private key
    $secret_iv = '5fgf5HcvbFGH%^*2345J5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
public function killChars($strWords)
	{
		$strWords=(htmlentities(trim(stripslashes(strip_tags(($strWords))))));
		$badChars = array("alert", ";", "--", "alter","alter routine","create","create routine","create table","create temporary tables","create view","delete","drop","truncate","event","execute","index","insert","lock tables","references","select","show view","trigger","update", "xp_","union","|","&",";","%","'",'"',"\'",'\"',"<>","()","+"); //,"$"  ,"@"
		$newChars = $strWords; 
		for($i=0;$i<count($badChars);$i++)
		{
			$newChars = str_replace($badChars[$i], "",$newChars);
		}		
		str_replace("'", "",str_replace('"', '',strip_tags($newChars)));
		return filter_var($newChars, FILTER_SANITIZE_STRING); 
	}
	public function rawquery($q)
    {
         $stmt = $this->conn->prepare($q);
		 //print_r($stmt);
		 exit;
		 $stmt->execute();
	
			  
		if (!$stmt) 
		 {
		   return false;
		 }
		 else
		 {
		 $data=array(); 
		  while ($row = $stmt->fetch(PDO::FETCH_OBJ)) 
		  {
			$data[]=$row;
  		  }
  
         $this->result=$data;
	     return true;
		 }
	
	}

	public function mquery($table, $rows = '*', $where = null, $order = null)
    {
        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;
			
		//echo $q;
		//exit(0);
		//return false;
	
	    $stmt = $this->conn->prepare($q);
		$stmt->execute();
	
			  
		if (!$stmt) 
		 {
		   return false;
		 }
		 else
		 {
		 $data=array(); 
		  while ($row = $stmt->fetch(PDO::FETCH_OBJ)) 
		  {
			$data[]=$row;
  		  }
  
         $this->result=$data;
	     return true;
		 }
		 
	  

	}
	
	public function mquery_group($table, $rows = '*', $where = null,$group=null)
    {
        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
        //if($order != null)
          //  $q .= ' ORDER BY '.$order;
		if($group != null)
            $q .= ' group BY '.$group;
		//echo $q;
		//exit(0);
	
	    $stmt = $this->conn->prepare($q);
		$stmt->execute();
	
			  
		if (!$stmt) 
		 {
		   return false;
		 }
		 else
		 {
		 $data=array(); 
		  while ($row = $stmt->fetch(PDO::FETCH_OBJ)) 
		  {
			$data[]=$row;
  		  }
  
         $this->result=$data;
	     return true;
		 }
		 
	  

	}
	
	public function squery($table, $rows = '*', $where = null)
    {
        $q = 'SELECT '.$rows.' FROM '.$table;
        if($where != null)
            $q .= ' WHERE '.$where;
    
			
	//echo $q;
	    $stmt = $this->conn->prepare($q);
		
		$stmt->execute();
	//print_r($stmt);
			  
		if (!$stmt) 
		 {
		  
		  return false;
		 }
		 else
		 {
	
	     $data="";
		  while ($row = $stmt->fetch(PDO::FETCH_OBJ)) 
		  {
			$data=$row;
			
  		  }
  
         $this->result=$data;
	        return true;
		 }
		 
	  

	}
	
	
	
	public function insert($table,$values,$rows = null)
    {
	
	        $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')';
            }

            for($i = 0; $i < count($values); $i++)
            {
               
				if(is_string($values[$i])&&$values[$i]!='NULL')
                    $values[$i] = "'".$values[$i]."'";
				elseif($values[$i]=='NULL')
				    $values[$i] = $values[$i];	
					
            }
		
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.')';
    	    
			//echo $insert;
			try {  
                     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                     $this->conn->beginTransaction();
                    $this->conn->exec($insert);
					$this->conn->commit();
  
                         return true;
  
           } catch (Exception $e) {
              $this->conn->rollBack();
			  //print_r($e);
                    return false;
           }
//return  $insert;

			
			//  $stmt = $this->conn->prepare($insert);
	    	//  $rid=$stmt->execute();
			  
		
			  
			  
			 // return $rid; 

   
					 
	}
	
	
	
	public function update($table,$rows,$where)
    {
	        $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i]."='".$rows[$keys[$i]]."'";
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }
                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
			//echo $update; exit;
	         try {  
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->conn->beginTransaction();
                    $this->conn->exec($update);
					$this->conn->commit();
                    return true;
            } catch (Exception $e) {
              $this->conn->rollBack();
               return false;
			   //return $e->getMessage();
	        }
	}
		
	public function update2($table,$rows,$where) // modified by suprakash for flexibility
    {
	        $update = 'UPDATE '.$table.' set ';
           $update .= $rows;
            $update .= ' WHERE '.$where;
			//echo $update;
	         try {  
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->conn->beginTransaction();
                    $this->conn->exec($update);
					$this->conn->commit();
                    return true;
            } catch (Exception $e) {
              $this->conn->rollBack();
               return false;
			   //return $e->getMessage();
	        }
	}
	
	public function insert_new($table,$rows)
    {
	
			
			$keys = array_keys($rows);
	        for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]])&&$rows[$keys[$i]]!='NULL')
                    $values[$i] = "'".$rows[$keys[$i]]."'";
				elseif($rows[$keys[$i]]=='NULL')
				    $values[$i] = $rows[$keys[$i]];	
					
            }
		
		    $keys = implode(',',$keys);
			
			
            $values = implode(',',$values);
            $insert = 'INSERT INTO '.$table;
			$insert .= ' ('.$keys.')';
            $insert .= ' VALUES ('.$values.')';
    	    
			
			//echo $insert;
			
			
			try {  
                     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                     $this->conn->beginTransaction();
                    $this->conn->exec($insert);
					$this->conn->commit();
  
                         return true;
  
           } catch (Exception $e) {
              $this->conn->rollBack();
                    return false;
				 // return $insert;
				  
           }
		   
		   
	
          
	

			
        }
		
		
		
		public function delete($table,$where)
    {

            $delete = 'delete from '.$table.' ';
            $delete .= ' WHERE '.$where;

		try {  
                     $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                     $this->conn->beginTransaction();
                    $this->conn->exec($delete);
					$this->conn->commit();
  
                         return true;
  
           } catch (Exception $e) {
              $this->conn->rollBack();
                    return false;
           }
		   
			
        }
		
         public function changepassword($a,$b,$c)
         {

    		$stmt = $this->conn->prepare("{CALL staff_change_password(?,?,?)}");
	    	$rid=$stmt->execute(array($a, $b, $c));
			return $rid; 
			
        }
		
		 public function execproc($a)
         {
		   $stmt = $this->conn->prepare($a);
		   $stmt->execute();
		   if (!$stmt) 
		  {
		   return false;
		  }
		  else
		  {
	       $data = ($stmt->fetchAll(PDO::FETCH_OBJ));
           $stmt->closeCursor();
		   $this->result=$data;
	        return true;
	   	 } 
		 	 
		 }
		 
		 
		  public function execproc_grade($a)
         {
		   $stmt = $this->conn->prepare($a);
		   $stmt->execute();
		   if (!$stmt) 
		  {
		   return false;
		  }
		  else
		  {
		
	       $data = ($stmt->fetchAll(PDO::FETCH_OBJ));
		   $stmt->nextRowset();
		   
		   $data1 = ($stmt->fetchAll(PDO::FETCH_OBJ));
		   $stmt->nextRowset();
		   $data2 = ($stmt->fetchAll(PDO::FETCH_OBJ));
		      $stmt->nextRowset();
		   $data3 = ($stmt->fetchAll(PDO::FETCH_OBJ));
		   	   
		   $stmt->closeCursor();
		   $this->result=$data;
		    $this->result1=$data1;
			 $this->result2=$data2;
			 $this->result3=$data3;
			 
	        return true;
	   	 } 
		 	 
		 }
		 
		 
		 
		 public function beginTransaction()
		 {
		  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->conn->beginTransaction();
		 }
		 public function commit()
		 {
		 $this->conn->commit();
		 }
		 
		public function rawexereturnid($query1)
        {
			try {                  
                     $this->conn->exec($query1);
                     $lastid=$this->conn->lastInsertId();
                      return $lastid;
  
                } 
			catch (Exception $e) 
			   {
                   $this->conn->rollBack();
                   return false;
               }
       }
	   
	   public function rawexe($query1)
        {
			try {                  
                     $this->conn->exec($query1);
                    
                      return true;
                  } 
			catch (Exception $e) 
			   {
                   $this->conn->rollBack();
                   return false;
               }
       }
	   
	
	   public function insert_new_return_id($table,$rows)
    {
	
			
			$keys = array_keys($rows);
	        for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]])&&$rows[$keys[$i]]!='NULL')
                    $values[$i] = "'".$rows[$keys[$i]]."'";
				elseif($rows[$keys[$i]]=='NULL')
				    $values[$i] = $rows[$keys[$i]];	
					
            }
		
		    $keys = implode(',',$keys);
			
			
            $values = implode(',',$values);
            $insert = 'INSERT INTO '.$table;
			$insert .= ' ('.$keys.')';
            $insert .= ' VALUES ('.$values.')';
    	    
			
			//echo $insert;
			
			
			try {  
                   
				 $stmt = $this->conn->prepare($insert);
		        $stmt->execute();
		   
				   return  $this->conn->lastInsertId($table);


             } catch (Exception $e) {
              $this->conn->rollBack();
                    return $e->getMessage()."";
             }
		   
		   
	
          
	

			
        }
		   
	   
	   
	   

public function insertreturnid($table,$values,$rows = null)
    {
	
	        $insert = 'INSERT INTO '.$table;
            if($rows != null)
            {
                $insert .= ' ('.$rows.')';
            }

            for($i = 0; $i < count($values); $i++)
            {
                if(is_string($values[$i])&&$values[$i]!='NULL')
                    $values[$i] = "'".$values[$i]."'";
				elseif($values[$i]=='NULL')
				    $values[$i] = $values[$i];	
					
            }
		
            $values = implode(',',$values);
            $insert .= ' VALUES ('.$values.');';
    	    
			
			
			try {  
                   
				 $stmt = $this->conn->prepare($insert);
		        $stmt->execute();
		   
				   return  $this->conn->lastInsertId($table);


             } catch (Exception $e) {
              $this->conn->rollBack();
                    return $e->getMessage()."";
             }

			
			//  $stmt = $this->conn->prepare($insert);
	    	//  $rid=$stmt->execute();
			  
		
			  
			  
			 // return $rid; 

   
					 
	        }
	
		
		

	
	    public function fetchdata()
	    {
		if (isset($this->result))
		{
		 $row = $this->result;	
		 return $row;
		}
		return false;
	    }
		
		public function fetchdata1()
	    {
		if (isset($this->result1))
		{
		 $row = $this->result1;	
		 return $row;
		}
		return false;
	    }
		
			public function fetchdata2()
	    {
		if (isset($this->result2))
		{
		 $row = $this->result2;	
		 return $row;
		}
		return false;
	    }
		
		public function fetchdata3()
	    {
		if (isset($this->result3))
		{
		 $row = $this->result3;	
		 return $row;
		}
		return false;
	    }
		
		
		
		
}