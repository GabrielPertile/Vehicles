{{-- Modal de cadastro --}}
<div class="modal" tabindex="-1" id="brandModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brandModalLabel">Nova marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="brandModal" method="post" action="{{ route('brands.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            class="@error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary" type="submit" id="formSubmit"
                        @disabled($errors->isNotEmpty())>Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <script>
    $(document).ready(function() {
        $('#formSubmit').click(function() {
            // Serialize the form data
            var formData = $('#brandModal').serialize();

            // Make the AJAX POST request to the controller
            $.ajax({
                type: 'POST',
                url: '/brands-brand', // Replace with your actual route URL
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // If success, show a success message
                    alert(response.message);
                    // Reset the form or perform any other action
                    // ...
                },
                error: function(xhr) {
                    // If there are validation errors, display the error messages
                    var errors = xhr.responseJSON.errors;
                    console.log(xhr.responseJSON);
                    $.each(errors, function(field, messages) {
                        alert(messages[
                        0]); // Show the first error message for each field
                    });
                }
            });
        });
    });
</script> --}}
