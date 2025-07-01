<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * @author CokesHome
 * @copyright Copyright (c) 2015, CokesHome
 * 
 * This is model class for table "users"
 */

class Users_model extends BF_Model
{
    /**
     * @var string  User Table Name
     */
    protected $table_name = 'users';
    protected $key        = 'id_user';

    /**
     * @var string Field name to use for the created time column in the DB table
     * if $set_created is enabled.
     */
    protected $created_field = 'created_on';

    /**
     * @var string Field name to use for the modified time column in the DB
     * table if $set_modified is enabled.
     */
    protected $modified_field = 'modified_on';

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $set_created = TRUE;

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = false;

    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = TRUE;

    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    protected $date_format = 'datetime';
    //--------------------------------------------------------------------

    /**
     * @var bool If true, will log user id in $created_by_field, $modified_by_field,
     * and $deleted_by_field.
     */
    protected $log_user = false;

    /**
     * Function construct used to load some library, do some actions, etc.
     */
    public function __construct()
    {
        parent::__construct();
    }
	
	function pilih_departemen()
    {
        $query="SELECT
                rs_departemen.id_departemen,
                rs_departemen.nama_departemen
                FROM
                rs_departemen";
        return $this->db->query($query);
    }
	
	function pilih_deptdokter($dept)
    {
        $query="SELECT
                rs_departemendokter.id_dokter,
                rs_dokter.nama_dokter				
                FROM
                rs_departemendokter
				inner join rs_dokter on rs_departemendokter.id_dokter = rs_dokter.id_dokter
				where rs_departemendokter.id_departemen ='$dept'";
        return $this->db->query($query);
    }
	
	function pilih_divisi()
    {
        $query="SELECT
                rs_divisi.id_div,
                rs_divisi.nama_div
                FROM
                rs_divisi";
        return $this->db->query($query);
    }
}