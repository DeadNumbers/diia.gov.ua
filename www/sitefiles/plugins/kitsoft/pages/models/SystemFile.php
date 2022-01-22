<?php namespace KitSoft\Pages\Models;

use System\Models\File;

/**
 * SystemFile Model
 */
class SystemFile extends File
{	
	/**
	 * 
	 */
	public function getPublicPath()
	{
		switch ($this->field_type) {
			case 'mediafinder':
				$path = media_url('');
				break;
			case 'fileupload':
			default:
				$path = parent::getPublicPath();
				break;
		}

		return $path;
	}

	/**
	 * getPartitionDirectory
	 */
	public function getPartitionDirectory()
	{
		switch ($this->field_type) {
			case 'mediafinder':
				$path = '';
				break;
			case 'fileupload':
			default:
				$path = parent::getPartitionDirectory();
				break;
		}

		return $path;
	}

	/**
     * Generates and returns a thumbnail path.
     */
    public function getThumb($width, $height, $options = [])
    {
    	switch ($this->field_type) {
			case 'mediafinder':
				$path = $this->path;
				break;
			case 'fileupload':
			default:
				$path = parent::getThumb($width, $height, $options);
				break;
		}

		return $path;
    }

    /**
     * scopeIsPublic
     */
    public function scopeIsPublic($query)
    {
    	return $query->where('is_public', true);
    }

    /**
     * getHashAttribute
     */
    public function getHashAttribute()
    {
    	return hash_file('md5', $this->getLocalPath());
    }

    /**
     * getSiteAttribute
     */
    public function getSiteAttribute()
    {
    	if (!$this->attachment) {
    		return;
    	}
    	
    	return $this->attachment->site;
    }
}