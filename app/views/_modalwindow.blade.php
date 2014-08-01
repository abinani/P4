{{-- Need to pass parameters $name and $title --}}

<div id="{{{$name}}}-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="{{{$name}}}-dismiss">&times;</button>
                <h4 class="modal-title">{{{$title}}}</h4>
            </div>
            <div class="modal-body">
                 @yield('modal-body')
            </div>
        </div>
    </div> 
</div>

<script type="text/javascript">
$(window).load(function(){
    $('#{{{$name}}}-modal').modal({show:true, keyboard: true});
});
</script>

