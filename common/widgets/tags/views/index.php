<?php
$tags =json_decode($data['inputValue'], true);
?>
<style>
    .select2-container--default .select2-selection--multiple {
        background-color: white;
        border: 1px solid #e5e6e7;
        cursor: text;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: 1px solid #e5e6e7;
        outline: 0 none;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #1ab394;
        color:#fff;
        border: none;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color:#fff;
    }

</style>

<div class="form-group field-members-pwd">
    <span style="color: red;padding: 10px 0">会员标签：
            <?php foreach($havetags as $v):?>
                <a href="javascript::" data-name="<?=$v['name']?>"><?=$v['name']?>,</a>
            <?php endforeach;?>
    </span>
    <select id="select6" name="tags[]" class="form-control select2-hidden-accessible" style="width: 100%" data-placeholder="请输入或选择标签" multiple="" tabindex="-1" aria-hidden="true">
        <?php if(!empty($tags)):?>
            <?php foreach ($tags as $value):?>
                <option value="<?=$value?>" selected=""><?=$value?></option>
            <?php endforeach;?>
        <?php endif;?>
    </select>
</div>
<script>
    $("span a").click(function(){
        var name = $(this).data('name');
        $('#select6').append('<option data-name="'+name+'" value="'+name+'" selected="">'+name+'</option>');
        $('.select2-selection__rendered').append('<li class="select2-selection__choice toremove" data-name="'+name+'"><span class="select2-selection__choice__remove" role="presentation">×</span>'+name+'</li>');

    })
    $(document).delegate('.select2-selection__choice',"click",function(){
        $(this).remove();
    })

</script>
