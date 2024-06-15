$(document).ready(function () {

    $('#level').change(function () {
        if ($(this).val() == 'Kaprodi' || $(this).val() == 'Dosen') {
            $('#apabila').html(`<div class="mb-3">
            <label class="form-label">NIDN Dosen</label>
                <select class="form-select form-control" name="nidn" id="nidn">
                    <option value="">--pilih nidn--</option>
                </select>
                </div>` );

            $.ajax({
                type: 'GET',
                url: '/getDosen',
                dataType: 'json',
                success: function (res) {
                    for(let i = 0; i < res[0].length; i++){
                        $('#nidn').append(`<option value='${res[0][i].id}'>${res[0][i].nidn}</option>`)
                    }
                }
            })
        }else if($(this).val() === 'Mahasiswa'){
            $('#apabila').html(`<div class="mb-3">
                <label class="form-label">NoBp Mahasiswa</label>
                    <select class="form-select form-control" name="nobp" id="nobp">
                        <option value="">--pilih nobp--</option>
                    </select>
                    </div>` );
    
                $.ajax({
                    type: 'GET',
                    url: '/getMahasiswa',
                    dataType: 'json',
                    success: function (res) {
                        for(let i = 0; i < res[0].length; i++){
                            $('#nobp').append(`<option value='${res[0][i].id}'>${res[0][i].nobp}</option>`)
                        }
                    }
                })
        }else{
            $('#apabila').html('');
        }
    });

});