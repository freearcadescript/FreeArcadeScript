<?php

class config{
    
    /*
     * Edit these variables
     */
    private $dbhost = 'localhost'; // Database host
    private $dbuser = 'DBUSER'; // Database user
    private $dbpass = 'DBPASS'; // Database password
    private $dbname = 'DBNAME'; // Database name

    // ////////////////////////////////////////////////////////////////////////////////////////////////////
	// You MUST edit the variable $cachepath below to your own hosting info. If you do not, you will get errors
	// At the very least you will need to replace "hostingaccountname" with your own account user name.
	// On some accounts you might need to edit the rest of the path. 
	//
	// Directory of the cache folder must exist, and must be chmod 777
	//
	// If you have questions, please ask for support
	// from either your hosting company or the Free Arcade Script staff.
	// ////////////////////////////////////////////////////////////////////////////////////////////////////
	// 
	// The folowing is more secure, but not everybody can use it. It still needs to be edited though.
	// $cachepath='/home/hostingaccountname/cache/';   
	// This one is one almost everybody can use, but is less secure. 

    private $cachepath=''; //location of cache folder
	private $cachelife = '60' ; //Amount of time a cache lives for in seconds

    /*
     * End edit
     */
    
    //returns the private variables
    public function getHost(){
        return $this->dbhost;
    }
    
    public function getUser(){
        return $this->dbuser;
    }
    
    public function getPass(){
        return $this->dbpass;
    }
    
    public function getName(){
        return $this->dbname;
    }

    public function getCachePath(){
        return $this->cachepath;
    }

    public function getCacheLife(){
        return $this->cachelife;
    }
        
}
?>