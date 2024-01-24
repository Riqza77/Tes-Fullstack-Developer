<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- File Input JS -->
<script src="{{ asset('/file_input/js/plugins/buffer.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/file_input/js/plugins/filetype.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/file_input/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/file_input/js/plugins/sortable.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/file_input/js/fileinput.min.js') }}"></script>
<script src="{{ asset('/file_input/js/locales/LANG.js') }}"></script>



<!-- Dropzone JS CDN -->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 2400,
        maxFiles: 4,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
    };
</script>
<!-- jQuery Datepicker JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker/daterangepicker.min.js"></script>

<!-- DataTables JS CDN -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@if (session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
@endif
<script type="text/javascript">
    $('#dateRangePicker').daterangepicker({
        opens: 'left',
        locale: {
            format: 'YYYY-MM-DD'
        }
    }, function(start, end, label) {
        fetchData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

    function fetchData(startDate, endDate) {
        $.ajax({
            url: "{{ route('getbyDate') }}",
            type: 'POST',
            data: {
                start_date: startDate,
                end_date: endDate,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data.success == 1) {

                    populateTable(data.data);
                } else {
                    $('#data_api').html(
                        '<tr><td colspan="11" class="text-center">Data Tidak Ditemukan</td></tr>');
                }
            },
            error: function(error) {
                console.log('Data Gagal Diambil');
            }
        });
    }

    $(document).ready(function() {

        $.ajax({
            url: "{{ route('get_api') }}",
            method: 'GET',
            success: function(data) {
                populateTable(data.data);
            },
            error: function(error) {
                console.log('Data Gagal Diambil');
            }
        });
        $('.form-select').select2();
        $('.tgl').datepicker({
            format: 'yyyy-mm-dd'
        });
        $("#foto").fileinput({
            rtl: true,
            showUpload: false,
            maxFileSize: 1024,
            allowedFileExtensions: ["jpg", "png", "gif"]
            // allowedFileExtensions: ["image/*", "pdf/*"]
        });
        $("#myForm").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                nama: {
                    required: "Nama Tidak Boleh Kosong",
                    minlength: "Nama Harus Kurang Dari 5"
                },
                email: {
                    required: "Email Tidak Boleh Kosong",
                    email: "Email Tidak Valid"
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo($("#error-" + element.attr("id")));
            },
            invalidHandler: function(event, validator) {
                var errors = validator.numberOfInvalids();
                console.log("Total errors: " + errors);
                alert("Form Error!");
            },
            submitHandler: function(form) {
                alert("Form submitted successfully!");
            }
        });

    });

    function populateTable(data) {
        var tableBody = $('#data_api');

        tableBody.empty();
        const idLocaleConfig = {
            weekdays: 'Minggu_Senin_Selasa_Rabu_Kamis_Jumat_Sabtu'.split('_'),
            weekdaysShort: 'Min_Sen_Sel_Rab_Kam_Jum_Sab'.split('_'),
            weekdaysMin: 'Mg_Sn_Sl_Rb_Km_Jm_Sb'.split('_'),
            months: 'Januari_Februari_Maret_April_Mei_Juni_Juli_Agustus_September_Oktober_November_Desember'.split(
                '_'),
            monthsShort: 'Jan_Feb_Mar_Apr_Mei_Jun_Jul_Ags_Sep_Okt_Nov_Des'.split('_')
        };

        moment.updateLocale('id', idLocaleConfig);
        var no = 1
        $.each(data, function(index, item) {

            if (item.foto) {
                var row = '<tr>' +
                    '<td>' + no++ + '</td>' +
                    '<td>' + item.nip + '</td>' +
                    '<td>' + item.nama + '</td>' +
                    '<td>' + item.jenis_kelamin + '</td>' +
                    '<td>' + item.email + '</td>' +
                    '<td> +62 ' + item.no_telp + '</td>' +
                    '<td>' + item.agama + '</td>' +
                    '<td>' + item.status_nikah + '</td>' +
                    '<td>' + moment(item.tgl_bergabung).format('dddd, DD MMMM YYYY') +
                    '</td>' +
                    '<td><img width="50" height="50" src="/storage/profil/' + item.foto + '" /></td>' +
                    '<td class="text-center"><a href="/detail/' + item.id +
                    '" class="m-2"><i class="fa fa-eye"></i></a> </td > ' +
                    '</tr>';
            } else {
                var row = '<tr>' +
                    '<td>' + no++ + '</td>' +
                    '<td>' + item.nip + '</td>' +
                    '<td>' + item.nama + '</td>' +
                    '<td>' + item.jenis_kelamin + '</td>' +
                    '<td>' + item.email + '</td>' +
                    '<td> +' + item.no_telp + '</td>' +
                    '<td>' + item.agama + '</td>' +
                    '<td>' + item.status_nikah + '</td>' +
                    '<td>' + moment(item.tgl_bergabung).format('dddd, DD MMMM YYYY') +
                    '</td>' +
                    '<td> Belum Ada Foto </td>' +
                    '<td class="text-center"><a href="/detail/' + item.id +
                    '" class="m-2"><i class = "fa fa-eye" ></i></a></td>' +
                    '</tr>';
            }


            tableBody.append(row);
        });

        $('#example').DataTable();

    }
</script>
