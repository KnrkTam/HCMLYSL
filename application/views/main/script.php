<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=assets_url('main/js/jquery.min.js')?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=assets_url('main/js/bootstrap.min.js')?>"></script>

<script>

    //csrf
    <?php if(config_item('csrf_protection')){ ?>
    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        if (options.type.toLowerCase() === "post") {
            // initialize `data` to empty string if it does not exist
            options.data = options.data || "";

            // add leading ampersand if `data` is non-empty
            options.data += options.data ? "&" : "";

            // add _token entry
            options.data += "<?=$this->security->get_csrf_token_name()?>=" + encodeURIComponent('<?=$this->security->get_csrf_hash()?>');
        }
    });
    <?php } ?>

</script>