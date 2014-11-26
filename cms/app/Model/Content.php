<?php

//https://github.com/josegonzalez/cakephp-upload

class Content extends AppModel {

    var $bigSize = "800x500";
    var $mediumSize = "600x300";
    var $thumbSize = "300x300";

    public $actsAs = array(
        'Upload.Upload' => array(
            'attachment' => array(
                'thumbnailSizes' => array(
                    'big' => "800x500",
                    'medium' => "600x300",
                    'thumb' => "300x300",
                ),
                'fields' => array(
                  'size' => 'size',
                  'type' => 'mime_type',
                  'dir' => 'host'
                ),
                'thumbnailMethod' => 'php',
                'deleteOnUpdate' => true
            ),
        ),
    );
    
    public $validate = array(
		'attachment' => array(
		    'rule' => array('isValidMimeType', array('image/png', 'image/jpg', 'image/jpeg', 'image/gif'), false),
		    'message' => 'File is not a jpg, png or gif'
		)
	);

    public $belongsTo = array(
        'Schedule' => array(
            'className' => 'Schedule',
            'foreignKey' => 'model_id',
        ),
    );

    /*
    //fungsi ini tidak jadi dipakai
    //karena ada deleteOnUpdate = true

    public function beforeSave($options = array()) {

      $savedData = $this->data[key($this->data)];

      $data = $this->find('first', array(
        'conditions' => array(
            'model_id' => $savedData['model_id'],
            'model' => $savedData['model']
        )
      ));

      if($data != false) {

        //delete image sebelum nya nih.

      }

      return true;
  }
  */

  //kalau berhasil di save, berarti kirim ke cloud nih bila ada embel2 save to cloud
  //bila mao di kirim ke cloud berarti deleteOnUpdate harusnya ga ada, soalnya kan sudah terkirim di sini.
  public function afterSave($created,$options = array())
  {
    if($created) {
        Configure::write('debug', 1);

        //pr($this->data);
    }

    return true;
  }

}
?>
