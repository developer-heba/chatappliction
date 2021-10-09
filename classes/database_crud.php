<?php
include('database_connection.php');
class database_crud extends Database_Connection {
  
        public function fetch($table,$where=''){
          $connect=$this->connect();
              $query = "
              SELECT * FROM $table 
              $where
              ";

            $statement = $connect->prepare($query);
            
            $statement->execute();

            $count= $statement->rowCount();
            $result = $statement->fetchAll();
            $data=array('rows'=>$result, 'count'=>$count);
            return $data;
        }
        public function fetch_field($table,$field,$where=''){
          $connect=$this->connect();
        
            $query ="SELECT $field FROM $table 
            $where"  ;
         

            $statement = $connect->prepare($query);
            
            $statement->execute();

            $count= $statement->rowCount();
            $result = $statement->fetchAll();
            $data=array('rows'=>$result, 'count'=>$count);
            return $data;
        }

        public function insert($table,$data){
          $connect=$this->connect();
          $fields=array_keys($data);
          $filed_value=array_values($data);
          $imagine_values='';
          
          for($i=0;$i<count($fields);$i++)
          {
            if($i==count($fields)-1){
              $imagine_values.=':'.$fields[$i];
            }else{
              $imagine_values.=':'.$fields[$i].',';
            }
           }
          $inser_fileds='';
          for($i=0;$i<count($fields);$i++)
          {
            if($i==count($fields)-1){
              $inser_fileds.=$fields[$i];
            }else{
              $inser_fileds.=$fields[$i].',';
            }
           }
       
          $query = "
          INSERT INTO $table 
          ($inser_fileds) 
          VALUES ($imagine_values)
          ";
          $array_keys = array_map(function($val) { return ':'.$val; }, $fields);//applay callback to the elements of array
          $executed_data=array_combine( $array_keys,$filed_value);
          $statement = $connect->prepare($query);
          
          
          if($statement->execute($executed_data))
          {
            $lastInsertId=$connect->lastInsertId();
            $insert_status=true;
            $data=array
            ('lastInsertId'=>$lastInsertId,
            'insert_status' =>$insert_status
          );
           
            return $data;
          
          }
          
      }

      public function update($table,$data_updated,$where)/*$data_updated
      assocciative array of updated field and value*/
      
      {
        $connect=$this->connect();
        $set_values='';
        $counter = count($data_updated);
        $i =0;
       
        foreach($data_updated as $key =>$value)
        {
          if(++$i ===$counter){
            $set_values.=$key.'='."'".$value."'";
          }else{
            $set_values.=$key.'='."'".$value."'".',';
          }
      
          
         }
        $query = "
        UPDATE $table 
        SET $set_values 
         $where
        ";
    
        $statement = $connect->prepare($query);
       
       $statement->execute();
        
        
      }

      }
      