<div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-2xl h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update Product
                </h3>
                <button id="btnCloseUpdateAnggaran" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="/anggaran" method="POST">
                @method('PUT')
                @csrf
                <input id="id" name="id" type="hidden">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                        <input oninput="updateFormattedCurrency(this)" type="number" name="jumlah" id="detail-jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$299">
                        <div id="formattedCurrency"></div>
                    </div>

                    <div>
                        <label for="kategori_anggaran_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori anggaran</label>
                        <select name="kategori_anggaran_id" id="kategori_anggaran2"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            {{-- @foreach ($kategoriAnggarans as $kt) --}}
                            <option id="valueSelectKategoriAnggaran" value=""></option>
                            {{-- @endforeach --}}
                        </select>
                    </div>

                    <div>
                        <label for="kategori-anggaran-update"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori Anggaran</label>
                        <select name="kategori_transaksi_id" id="kategori-anggaran-update"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select category</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update product
                    </button>
                    @if (auth()->user()->can('hapus anggaran'))
                    <button id="btn-delete" type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Delete
                    </button>
                    @else
                    <button disabled id="btn-delete" type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Delete
                    </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function updateFormattedCurrency(input) {
   // Mengambil nilai yang dimasukkan oleh pengguna
   let value = input.value;

   // Menghilangkan semua karakter selain digit dan koma (,)
   value = value.replace(/[^\d,]/g, '');

   // Mengganti semua koma (,) yang tidak memiliki digit setelahnya dengan titik (.)
   value = value.replace(/,(?![\d,]*\d)/g, '.');

   // Menghapus semua simbol "Rp"
   value = value.replace(/Rp/g, '');

   // Mengubah nilai menjadi format angka
   const numericValue = parseFloat(value) || 0;

   // Mengubah nilai menjadi format mata uang
   const formatMataUang = numericValue.toLocaleString('id-ID', {
       style: 'currency',
       currency: 'IDR',
   });

   // Menampilkan nilai dalam format mata uang di elemen lain
   document.getElementById("formattedCurrency").textContent = formatMataUang;
}
</script>
