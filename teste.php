

<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">

<script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>
    $(document).ready(function() { 

$('input').tagsinput({
  typeahead: {
    source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo'],
        afterSelect: function() {
            this.$element[0].value = '';
        }
  }
});
});
</script>

<input type="text" class="form-control" rows="3" value="Test1,Test2, test3, test4, ThisIsABigVeryBigTest"  />