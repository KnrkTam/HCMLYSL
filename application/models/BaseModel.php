<?php
	use Illuminate\Database\Eloquent\Model as Eloquent;
	use Illuminate\Database\Eloquent\SoftDeletes;

	class BaseModel extends Eloquent
	{
		const ORDER_BY = 'id';
		const ORDER_BY_SORTING = 'ASC';
		//const CREATED_AT = 'created_at';
		//const UPDATED_AT = 'lastupdate';
		//const DELETED_AT = 'deleted_at';

		protected $dateFormat = 'Y-m-d H:i:s';

		protected $guarded = [];
		//protected $hidden = ['created_at', 'created_by', 'lastupdate', 'updated_by', 'deleted_at', 'deleted_by'];

		protected static $_allowDeleted = false;

		//use SoftDeletes;

		/**
		 * Setup model event for manipulating
		 * created_by and updated_by field when updating database
		 */
		/*public static function boot()
		{
			parent::boot();

			//Eloquent models fire several events, allowing you to hook into various points in the model's lifecycle using the following methods: creating, created, updating, updated, saving,  saved, deleting, deleted, restoring, restored.

			static::creating(function ($model) {
				$model->created_at = date("Y-m-d H:i:s");
				$model->updated_at = date("Y-m-d H:i:s");
				if ($_SESSION['login_id']) {
					$model->created_by = $_SESSION["login_id"];
					$model->updated_by = $_SESSION['login_id'];
				} else {
					$model->created_by = '0';
					$model->updated_by = '0';
				}
			});

			static::updating(function ($model) {
				$model->updated_at = date("Y-m-d H:i:s");
				if ($_SESSION['login_id']) {
					$model->updated_by = $_SESSION['login_id'];
				} else {
					$model->updated_by = '0';
				}
				$model->updated_by = '111';
			});

			static::deleting(function ($model) {
				$model->deleted_at = date("Y-m-d H:i:s");
				if ($_SESSION['login_id']) {
					$model->deleted_by = $_SESSION['login_id'];
				} else {
					$model->deleted_by = '0';
				}
			});

			static::saving(function ($model) {
				$model->updated_at = date("Y-m-d H:i:s");
				if ($_SESSION['login_id']) {
					$model->updated_by = $_SESSION['login_id'];
				} else {
					$model->updated_by = '0';
				}
				$model->updated_by = '111';

				var_dump($model);
				exit;
			});
		}*/

		public function newQuery($excludeDeleted = true)
		{
			// dd(get_class($this));
			$query = parent::newQuery($excludeDeleted);
			if (!static::$_allowDeleted) {
				$query->where($this->table . '.deleted', 0);
			} else {
				static::$_allowDeleted = false;
			}
			return $query;
		}

		public function delete()
		{
			$this->deleted = 1;
			return $this;
		}

	}
