  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ url('frontend/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('frontend/js/popper.min.js') }}"></script>
    <script src="{{ url('frontend/js/bootstrap.js') }}"></script>
    <script src="{{ url('frontend/js/all.js') }}"></script>

    <script  type="text/javascript">
       $(document).ready(function() {
            $('#tabel_category').DataTable({
            processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('category.index') }}",
                    type:'GET'
                },
              
                columns: [
                    // {data:'kode_fakultas',name:'kode_fakultas'},
                    {data:'name',name:'name'},
                    {data:'action',name:'action'}
                ],
                order: [[0, 'asc']]

            })
          
        } );
    </script>