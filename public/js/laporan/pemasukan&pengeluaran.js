
const tabelBody = document.getElementById('tabelBody')
const tabelRowPem= Array.from(document.querySelectorAll('#tabelRowPem'))

function acttionFilter(target) {
    console.log(target);
    tabelRowPem.forEach(tr => {
        while(tr.firstChild) {
            tr.removeChild(tr.firstChild)
        }
    })
    fetch('get_pemasukan_by_kategori_transaksi_id/?id=' + target.getAttribute('data-id') + '&jenis_transaksi_id=' + target.getAttribute('data-id-2'))
        .then(response => response.json())
        .then(data => {
            console.log(data);
            data.forEach((item, index) => {
                let element = `
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.no_transaksi}</th>
                                <td class="px-4 py-3">${item.tanggal}</td>
                                <td class="px-4 py-3">${item.kategori}</td>
                                <td class="px-4 py-3">${item.supplier}</td>
                                <td class="px-4 py-3">${item.deskripsi}</td>
                                <td class="px-4 py-3">Rp ${item.jumlah}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#"
                                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                        </div>
                                    </div>
                                </td>`
                tabelRowPem[index].innerHTML = element
            });
        })

    
}

function acttionPeriode(target) {
    const linkPrint = document.getElementById('linkPrint')
    const linkExcel = document.getElementById('linkExcel')
    const linkPrintPengeluaran = document.getElementById('linkPrintPengeluaran')
    const linkExcelPengeluaran = document.getElementById('linkExcelPengeluaran')
   if(linkPrint != null || linkExcel != null) {
    linkPrint.setAttribute('href', `/pdf_laporan_pemasukan/?id=${target.getAttribute('data-id')}`)
    linkExcel.setAttribute('href', `/pemasukan_xlsx/?id=${target.getAttribute('data-id')}`)
   }
    if(linkPrintPengeluaran != null || linkExcelPengeluaran != null) {
        linkPrintPengeluaran.setAttribute('href', `/pdf_laporan_pengeluaran/?id=${target.getAttribute('data-id')}`)
        linkExcelPengeluaran.setAttribute('href', `/pengeluaran_xlsx/?id=${target.getAttribute('data-id')}`)
    }
    tabelRowPem.forEach(tr => {
        while(tr.firstChild) {
            tr.removeChild(tr.firstChild)
        }
    })
    fetch('/get_pemasukan_by_month/?id=' + target.getAttribute('data-id') + '&jenis_transaksi_id=' + target.getAttribute('data-id-2'))
        .then(response => response.json())
        .then(data => {
            data.forEach((item, index) => {
                let element = `
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.no_transaksi}</th>
                                <td class="px-4 py-3">${item.tanggal}</td>
                                <td class="px-4 py-3">${item.kategori}</td>
                                <td class="px-4 py-3">${item.supplier}</td>
                                <td class="px-4 py-3">${item.deskripsi}</td>
                                <td class="px-4 py-3">Rp ${item.jumlah}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#"
                                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                        </div>
                                    </div>
                                </td>`
                tabelRowPem[index].innerHTML = element
            });
        })

    
}