jQuery(document).ready(function($){     $('select[name="nivo_settings[type]"]').change(function(){        if($('option:selected', this).val() == 'gallery'){            $('#nivo_type_gallery').show();        } else {            $('#nivo_type_gallery').hide();        }                if($('option:selected', this).val() == 'category'){            $('#nivo_type_category').show();        } else {            $('#nivo_type_category').hide();        }                if($('option:selected', this).val() == 'category' || $('option:selected', this).val() == 'sticky'){            $('#nivo_type_captions').show();        } else {            $('#nivo_type_captions').hide();        }                $('#nivoslider_upload_box').removeClass('slider-type-manual slider-type-gallery slider-type-category slider-type-sticky');        $('#nivoslider_upload_box').addClass('slider-type-'+ $('option:selected', this).val());    });        if($('select[name="nivo_settings[type]"] option:selected').val() == 'gallery'){        $('#nivo_type_gallery').show();    }        if($('select[name="nivo_settings[type]"] option:selected').val() == 'category'){        $('#nivo_type_category').show();    }        if($('select[name="nivo_settings[type]"] option:selected').val() == 'category' ||       $('select[name="nivo_settings[type]"] option:selected').val() == 'sticky'){        $('#nivo_type_captions').show();    }        $('#nivoslider_upload_box').addClass('slider-type-'+ $('select[name="nivo_settings[type]"] option:selected').val());});