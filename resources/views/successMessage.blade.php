@if ($message = Session::get('success'))
    <div id="successMessage">
        <p class="alert alert-success">{{ $message }}</p>
    </div>
@endif

<script>
    $(document).ready(function(){
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 1500); 
    });
</script>