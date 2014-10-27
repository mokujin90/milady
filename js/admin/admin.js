var license = {
    init:function(){
        $('select[name="license_type"]').change(function(){
            var id = $(this).val(),
                $fullParams = $('#edit-license'),
                $upgrade = $('#update-license');
            if(id==0){
                $fullParams.slideDown();
                $upgrade.slideUp();
            }
            else{
                $upgrade.find('input:visible').val('0');
                $fullParams.slideUp();
                $upgrade.slideDown();
            }
        });
    }
}