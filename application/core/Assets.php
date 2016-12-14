<?php

namespace Adspace\Core;

Class Assets
{
    public static function render_css($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        echo '<link href="'.SURL.'assets/'.$filename.'.css?t='.time().'" rel="stylesheet" type="text/css">';

    }
	
    public static function render_js($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        echo '<script type="text/javascript" src="'.SURL.'assets/'.$filename.'.js?t='.time().'"></script>';

    }

    public static function render_externaljs($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        echo '<script type="text/javascript" src="'.$filename.'"></script>';

    }
	
	public static function css($filenames, $data = null)
	{
        if (!is_array($filenames)) {
            self::render_css($filenames, $data); 
            return false;
        }

        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        foreach($filenames as $filename) {
            echo '<link href="'.SURL.'assets/'.$filename.'.css?t='.time().'" rel="stylesheet" type="text/css">';
        }

	}
	
	public static function js($filenames, $data = null)
	{
        if (!is_array($filenames)) {
            self::render_js($filenames, $data); 
            return false;
        }

        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        foreach($filenames as $filename) {
            echo '<script type="text/javascript" src="'.SURL.'assets/'.$filename.'.js?t='.time().'"></script>';
        }

	}

    public static function externaljs($filenames, $data = null)
    {
        if (!is_array($filenames)) {
            self::render_externaljs($filenames, $data); 
            return false;
        }

        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }

        foreach($filenames as $filename) {
            echo '<script type="text/javascript" src="'.$filename.'"></script>';
        }

    }

    public static function mainjs($data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        
        echo '<script src="'.SURL .'js.php?t='.time().'"></script>';

    }
}