require(
    [
        'Magento_Ui/js/lib/validation/validator',
        'jquery',
        'mage/translate'
    ], function(validator, $){

        validator.addRule(
            'custom-validation',
            function (value) {
                //return true or false based on your logic
                return value < 10 && value >0;
                // if(value.length<2 && value !=0){
                //     return true;
                // }
            }
            ,$.mage.__('Rating is must be between 1 and 10.')
        );
    });