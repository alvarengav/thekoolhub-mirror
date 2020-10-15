<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="padding:0">
    <div class="modal-content">
    </div>
  </div>
</div>

<script>
    $('document').ready(function() {
        $('.show_modal_info').click(function() {
            var info = $(this).attr('data-info');
            $('#infoModal .modal-content').html('');

            $.get( App.config.url+'info/'+info, function( data ) {
                $('#infoModal .modal-content').html(data);
                $('#infoModal').modal();
            });

        });
    });
</script>