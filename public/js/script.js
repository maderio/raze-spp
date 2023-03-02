// created by ChatGPT
$(document).ready(function () {
  $('.checkbox-spp').change(function () {
    var total = 0;
    $('.checkbox-spp:checked').each(function () { // loop melalui checkbox yang dicentang dengan kelas checkbox-spp
      total += parseFloat($(this).data('nominal')); // tambahkan nilai nominal dari checkbox yang dipilih
    });
    // $('#total').text('Total: Rp ' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    modal = $('#modalTambahTransaksi');
    modal.find('#modalTransaksiTotalNominal').html('Rp ' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
  });

  $('#modalTambahTransaksi').on('click', 'button.btn-success', function () {
    form = $('#transaksiForm').submit()
  })

  $('#transaksiButton').on('click', function () {
    console.log('clicked')
  })
})