<?php

	class productspec
	{
	
			private $id;
			private $product_id;	
			private $product_spec_type;
			private $product_data;
			private $table_name;
			
			
			public function SetId($id)
			{
					$this->id=$id;
			}
			public function GetId()
			{
					return $this->id;
			}

			public function SetProductID($product_id)
			{
					$this->product_id=$product_id;
			}
			public function GetProductID()
			{
					return $this->product_id;
			}
	
			public function SetProductSpecType($product_spec_type)
			{
					$this->product_spec_type=$product_spec_type;
			}
			public function GetProductSpecType()
			{
					return $this->product_spec_type;
			}

			public function SetProductData($product_data)
			{
					$this->product_data=$product_data;
			}
			public function GetProductData()
			{
				return $this->product_data;
			}
			
			public function SetTableName($table_name)
			{
					$this->table_name=$table_name;
			}
			public function GetTableName()
			{
				return $this->table_name;
			}
			
			function __construct()
			{
	
			}
			
			
	
	}
	
	
	

?>