<script>
    var token_handler = "<?= $csrf_token ?>";
    document.querySelector('form').innerHTML = `<input type="hidden" name="b3df6e650330df4c0e032e16141f" value="${token_handler}">`+document.querySelector('form').innerHTML;
    // $('form').each(function(){
    //     document.querySelector(`form#${this.id}`).innerHTML = document.getElementById(`form#${this.id}`).innerHTML
    // })
</script>