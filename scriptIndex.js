$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
  const btnDenah = document.querySelector('.btnDenah');
  const  btnOrderList = document.querySelector('.btnOrderList');
  const containerDenah = document.querySelector('.containerDenah');
  const allMeja = document.querySelectorAll('.meja');
  let index = 1;
  const mejaAtas = document.querySelector(".atas");
  const mejaBawah = document.querySelector(".bawah");
  const mejaKiri = document.querySelector(".kiri");
  const mejaKanan = document.querySelector(".kanan");
  const mejaTengah = document.querySelectorAll(".tengah");
  for (let meja of allMeja) {
      if(index <= 4){
          mejaAtas.appendChild(meja);
      }else if(index <= 8){
          mejaBawah.appendChild(meja);
      }else if(index <= 10){
          mejaKiri.appendChild(meja);
      }else if(index <= 12){
          mejaKanan.appendChild(meja);
      }else if(index <= 14){
          mejaTengah[0].appendChild(meja);
      }else if(index <= 16){
          mejaTengah[1].appendChild(meja);
      }else if(index <= 18){
          mejaTengah[2].appendChild(meja);
      }else if(index <= 20){
          mejaTengah[3].appendChild(meja);
      }
      index++;
  }

  const containerOrderList = document.querySelector('.containerOrderList');
  const containerLegenda = document.querySelector(".legenda");
  

  btnDenah.addEventListener("click", ()=>{
      containerDenah.toggleAttribute('hidden');
      containerOrderList.toggleAttribute('hidden');
      containerLegenda.toggleAttribute('hidden');

  });

  btnOrderList.addEventListener("click", ()=>{
      containerDenah.toggleAttribute('hidden');
      containerOrderList.toggleAttribute('hidden');
      containerLegenda.toggleAttribute('hidden');
  })
  
  // =======================   meja ===============================
  let rows = document.querySelectorAll(".meja");
  for (const row of rows) {
      row.addEventListener("click", async (e)=>{
          const modalBody = document.querySelector('.modal-body');
          const modalTitle = document.querySelector('.modal-title');
          document.querySelector('.modal-dialog').classList.remove('modal-lg');
          let id_meja = await row.dataset.id;
          let statusMeja = await row.dataset.status;
          
          if (statusMeja == "kosong") {
            if(tipe === "Kasir"){
                namaSession = "";
                emailSession = "";
            }
              let	isi =`
<h3>Meja Masih kosong</h3>
<button type="button" class="btn btn-secondary reservasiToggle">Reservasi</button>
<a href="menu.php?izin=true&meja=${id_meja}"><button type="button" class="btn btn-primary tombolPesan1">Pesan</button></a>
<div class="formReservasi" hidden>
  <form action="reservasi.php" method="POST">
  <br>
            <h5>Jam Operasional 10:00 - 23:00</h5>
      <input type="hidden" name="id" value="${id_meja}">
      <label for="no">Jam Mulai:</label>
      <input name="jam" type="text" class="form-control inputWaktu mt-3" placeholder="Jam" id="no" maxlength = "2">
      <input name="menit" type="text" class="form-control inputWaktu mt-3" placeholder="Menit" value="00" readonly maxlength = "2">
      <br>
      <label for="no2">Jam Berakhir:</label>
      <input name="jam2" type="text" class="form-control inputWaktu mt-3" placeholder="Jam" id="no2" maxlength = "2">
      <input name="menit2" type="text" class="form-control inputWaktu mt-3" placeholder="Menit" value="00" readonly maxlength = "2">
      <br>
      <label for="nama">Nama</label>
      <input name="nama" type="text" class="form-control" value="${namaSession}" id="nama" placeholder="Nama Pelanggan">
      <label for="email">Email</label>
      <input name="email" type="text" class="form-control" value="${emailSession}" id="email" placeholder="Email">
      <label for="no">No Telepon</label>
      <input name="no" type="text" class="form-control" id="no" placeholder="Nomor Telepon">
      <button name="submit" class="btn btn-primary mt-3">submit</button>
  </form>
</div>`; 
              modalBody.innerHTML = isi;
              modalTitle.textContent = `Meja ${id_meja}`;
              let reservasiToggle = document.querySelector(".reservasiToggle")
              if(tipe === "Kasir" || tipe === "Pelanggan" ){
                  reservasiToggle.addEventListener('click', function(){
                      if(tipe === "Kasir" || tipe === "Pelanggan" ){
                          document.querySelector(".formReservasi").toggleAttribute('hidden');
                        }else{
                            alert("Anda Tidak Mempunyai Akses");
                            window.location = 'index.php';
                            document.querySelector('.modal').hidden = true;
                        }
                    })
                }else{
                    reservasiToggle.hidden = true;
                }
                let tombolPesan1 = document.querySelector(".tombolPesan1");
                var today = new Date();
                var time = today.getHours();
                if(time < 10){
                    console.log("bener");
                    tombolPesan1.disabled = true;
                }
                
                document.querySelector('input[name="menit"]').addEventListener("input",(e)=>{
                console.log(typeof e.target.value);
                if(e.target.value >= 60){
                    alert("Mohon Masukkan Format menit");
                    document.querySelector('input[name="menit"]').value = "";
                }
            });
            document.querySelector('input[name="menit2"]').addEventListener("input",(e)=>{
                console.log(typeof e.target.value);
                if(e.target.value >= 60){
                    alert("Mohon Masukkan Format menit");
                    document.querySelector('input[name="menit2"]').value = "";
                }
            });
            let inputJam4 =  document.querySelector('input[name="jam2"]');
            let inputJam3 =  document.querySelector('input[name="jam"]');
            inputJam3.addEventListener("input",(e)=>{
                if(inputJam3.value  > 23 ){
                    alert("Jam Operasional 10:00 - 23:00");
                    inputJam3.value = "";
                }
                if(inputJam3.value.length == 2){
                    if(inputJam3.value <= time){
                        alert("Waktu Sudah Berlalu");
                        inputJam3.value = "";
                    }
                }
            });
            
            inputJam4.addEventListener("input",(e)=>{
                if(inputJam4.value  > 23 ){
                    alert("Jam Operasional 10:00 - 23:00");
                    inputJam4.value = "";
                }
                if(inputJam4.value.length == 2){
                    if(inputJam4.value < document.querySelector('input[name="jam"]').value){
                        alert("Tidak boleh kurang dari jam Awal");
                        inputJam4.value = '';
                    }

                    if(inputJam4.value  === document.querySelector('input[name="jam"]').value){
                        alert("Waktu reservasi Minimal 1 jam");
                        inputJam4.value = '';
                    }
                    if(inputJam4.value <= time){
                        alert("Waktu Sudah Berlalu");
                        inputJam4.value = "";
                    }
                
                }
            });
          }else if(statusMeja == "aktif"){
            
              document.querySelector('.modal-dialog').classList.add('modal-lg');
              let data = await row.dataset.menu;
              console.log(id_meja)
              console.log(data);
              data = data.replace(/\'/g, '"');
              const menu = JSON.parse(data);
              modalTitle.textContent = `Meja ${id_meja}`;
              let isi = `
      <form action="cetakStruk.php" method="POST">
      <a href="menu.php?izin=true&meja=${id_meja}"><button type="button" class="btn btn-primary mb-3">Pesan</button></a>
          <input type="hidden" name="idSumber" value="1">
      <input type="hidden" name="id_meja" value="${id_meja}">
          <table class="mb-3" cellpadding="6">`;
              let ket = 'Keterangan : <br>';
              let totalOrder = 0;
              for (makan of menu) {
                  totalOrder += makan.total;
                  ket += `- ${makan.ket}<br>`
                  isi += `
                  <tr>
                      <td>${makan.id}</td>
                      <td>${makan.nama}</td>
                      <td>${makan.quantity} Porsi</td>
                      <td>${makan.total}</td>
                  </tr>`;
              }
              isi += `<tr style="border-top:1px solid;"><td colspan="3" align="right">Total :</td><td align="right">${totalOrder}</td></tr>`;
              isi += `<tr><td colspan="4">${ket}</td></tr></table>`;
              isi += `
              <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Input Uang</button>
              <button type="submit" disabled id="btnKonfirmasi" class="btn btn-info">Konfirmasi Bayar</button>
              <div id="demo" class="collapse">
              <input id="inputUang" name="inputUang" type="text" class="form-control mt-3" placeholder="Masukkan Pembayaran">
              </div> 
              <input type="hidden" name="total" value="${totalOrder}">
              </form>
              `;
              modalBody.innerHTML = isi;
              const inputUang = document.querySelector("#inputUang");
              inputUang.addEventListener("input",(e)=>{
                  if(tipe === "Koki" || tipe === "Pelayan"){
                      alert("Anda tidak mempunyai akses");
                      inputUang.value = "";
                      document.querySelector('#btnKonfirmasi').disabled = true;
                  }
                  if(inputUang.value >= totalOrder && tipe === "Kasir"){
                      document.querySelector('#btnKonfirmasi').disabled = false;
                  }else{
                      document.querySelector('#btnKonfirmasi').disabled = true;
                  }
              });
          }else if(statusMeja == "reservasi"){
            if(tipe === "Pelanggan" || tipe === "Kasir" || tipe === "Pelayan"){
                let nama_pelanggan = await row.dataset.pelanggan;
                let jamAntri = []
                let idReservasi = await row.dataset.antrian;
                let dataReservasiJs = await row.dataset.datareservasi; 
                let data2 = dataReservasiJs.replace(/\'/g, '"');
                let realDataReservasi = JSON.parse(data2);
                let jamAwal = new Array(realDataReservasi.length);
                let strSortAntrian = [];
                var i = 0;
                var today = new Date();
                var time = today.getHours();
                let dataAntrian = [];
                let ketemu;
                let jamAkhirTest;
                let antrianLewat = [];
                for (let dataRealReservasi of realDataReservasi) {
                    jamAwal = new Array();
                    jamAwal[0] = dataRealReservasi.jam.substring(0, 2);
                    jamAwal[1] = dataRealReservasi.id;
                    jamAwal[2] = dataRealReservasi.nama;
                    jamAwal[3] = dataRealReservasi.jam;
                    dataAntrian.push(jamAwal);
                    strSortAntrian.push(dataRealReservasi.id);
                    jamAkhirTest =dataRealReservasi.jam.substr(6, 2);
                    // console.log(jamAwal[0],jamAkhirTest);
                    if(jamAwal[0] < time){
                        antrianLewat.push(jamAwal[1]);
                    }
                    if(time == jamAwal[0]){
                        if(jamreservasianda  === "NULL"){
                                jamreservasianda = jamAwal[0];
                                newIdReservasi = jamAwal[1];
                                ketemu = true;
                        }else{
                            ketemu = false
                        }
                    }else if(time >= jamAwal[0] && time <= jamAkhirTest){
                        if(jamreservasianda  === "NULL"){
                            jamreservasianda = time;
                            newIdReservasi = 1;
                            ketemu = true;
                        }else{
                            ketemu = false
                        }
                    }
                    i++;
                }
                console.log(antrianLewat.join().split(","));
                let arrayBaru = [];
                let minimum = [23];
                for (let iterator of dataAntrian) {
                   var b = iterator
                   if(b[0] < minimum[0]){
                     minimum = b;
                   }
                }
                dataAntrian.sort(sortFunction);

                function sortFunction(a, b) {
                    if (a[0] === b[0]) {
                        return 0;
                    }
                    else {
                        return (a[0] < b[0]) ? -1 : 1;
                    }
                }

                console.log("minimum",minimum);
                function removeA(arr) {
                    var what, a = arguments, L = a.length, ax;
                    while (L > 1 && arr.length) {
                        what = a[--L];
                        while ((ax= arr.indexOf(what)) !== -1) {
                            arr.splice(ax, 1);
                        }
                    }
                    return arr;
                }
                
                console.log("dataAntrian",dataAntrian);
                let realSortAntrian = [];
                for (const iterator3 of dataAntrian) {
                    realSortAntrian.push(iterator3[1])
                }
                console.log("realSortAntrian",realSortAntrian);

                let indexdummy = 0;
                for (let iterator4 of antrianLewat.join().split(",")) {                    
                    removeA(realSortAntrian, iterator4);
                    for(var i = 0; i <= dataAntrian.length - 1; i++){
                        if(dataAntrian[i][1] == iterator4){
                            dataAntrian.splice(i--,1);
                        }
                    }
                    indexdummy++;
                }
                
                console.log("realSortAntrianAfter",realSortAntrian);
                console.log("dataAntrianAFTER",dataAntrian);

                // const index = strSortAntrian.indexOf(minimum[1]);
                // if (index > -1) {
                //     strSortAntrian.splice(index, 1);
                // }
                // strSortAntrian.unshift(minimum[1]);
                // if(!ketemu){
                //     var newIdReservasi = minimum[1];
                // }
                // let newNama_pelanggan = minimum[2];
                // var joinStrSortAntrian = strSortAntrian.join();
                // console.log("strSortAntrian.join()",strSortAntrian.join());
                
                if(!ketemu){
                    var newIdReservasi = dataAntrian[1];
                }
                let newNama_pelanggan = dataAntrian[2];
                // var joinStrSortAntrian = strSortAntrian.join();
                console.log("strSortAntrian.join()",strSortAntrian.join());
                let list = `<table class="table">
                <thead>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jam</th>
                </thead>
                <tbody>`;
                let jamMulai = [];
                let jamAkhir = [];
                for (let dataRealReservasi of dataAntrian) {
                    list += `<tr><td>${dataRealReservasi[1]}</td><td>${dataRealReservasi[2]}</td><td>${dataRealReservasi[3]}</td></tr>`;  
                    jamMulai.push(dataRealReservasi[3].substring(0, 2));
                    jamAkhir.push(dataRealReservasi[3].substr(6, 2));
                }
                console.log("jam Mulai", jamMulai);
                console.log("jam Akhir", jamAkhir);
                console.log("time",time);
                list += `</tbody>
                </table>`;
              modalTitle.textContent = `Meja ${id_meja}`;
              let hidden = "";
              if(tipe === "Pelanggan"){
                hidden = "hidden";
              }
              if(newNama_pelanggan !== undefined){
                nama_pelanggan = newNama_pelanggan;
              }
              
              let	isi =`
            <h3>Meja Reservasi Milik ${nama_pelanggan}</h3>
            <a href="menu.php?from=reservasi&jamreservasi=${jamreservasianda}&izin=true&idReservasi=${realSortAntrian[0]}&antrian=${realSortAntrian.join()}&meja=${id_meja}"><button type="button" class="btn btn-primary tombolPesan2">Pesan</button></a>
            <a href="kosong.php?antri=${idReservasi}"><button type="button" class="btn btn-primary" ${hidden}>Kosongkan</button></a>
            <button type="button" class="btn btn-secondary reservasiToggle">Reservasi</button>
            <br><br><h5>Jadwal Reservasi</h5>
            ${list}
            <br>
            <div class="formReservasi" hidden>
            <form action="reservasi.php" method="POST">
            <h5>Jam Operasional 10:00 - 23:00</h5>
                <input type="hidden" name="id" value="${id_meja}">
                <input type="hidden" name="tambah" value="true">
                <label for="no">Jam Mulai:</label>
                <input name="jam" type="text" class="form-control inputWaktu mt-3" placeholder="Jam" id="no" maxlength = "2">
                <input name="menit" type="text" class="form-control inputWaktu mt-3" placeholder="00" value="00" maxlength = "2"  readonly>
                <br>
                <label for="no">Jam Berakhir:</label>
                <input name="jam2" type="text" class="form-control inputWaktu mt-3" placeholder="Jam" id="no" maxlength = "2">
                <input name="menit2" type="text" class="form-control inputWaktu mt-3" placeholder="00" value="00" maxlength = "2" readonly >
                <br>
                <label for="nama">Nama</label>
                <input name="nama" type="text" class="form-control" value="${namaSession}" id="nama" placeholder="Nama Pelanggan">
                <label for="email">Email</label>
                <input name="email" type="text" class="form-control" value="${emailSession}" id="email" placeholder="Email">
                <label for="no">No Telepon</label>
                <input name="no" type="text" class="form-control" id="no" placeholder="Nomor Telepon">
                <button name="submit" class="btn btn-primary mt-3">submit</button>
            </form>
            </div>
            `;              
                modalBody.innerHTML = isi;
                let tombolPesan2 = document.querySelector(".tombolPesan2");
                var today = new Date();
                var time = today.getHours();
                if(time < 10){
                    console.log("bener");
                    tombolPesan2.disabled = true;
                }
                document.querySelector(".reservasiToggle").addEventListener('click', function(){
                      document.querySelector(".formReservasi").toggleAttribute('hidden');
                })
                document.querySelector('input[name="menit"]').addEventListener("input",(e)=>{
                    console.log(typeof e.target.value);
                    if(e.target.value >= 60){
                        alert("Mohon Masukkan Format menit");
                        document.querySelector('input[name="menit"]').value = "";
                    }
                });

                let inputJam1 = document.querySelector('input[name="jam"]');
                let inputJam2 = document.querySelector('input[name="jam2"]')
                document.querySelector('input[name="menit2"]').addEventListener("input",(e)=>{
                    console.log(typeof e.target.value);
                    if(e.target.value >= 60){
                        alert("Mohon Masukkan Format menit");
                        document.querySelector('input[name="menit2"]').value = "";
                    }
                });
                inputJam1.addEventListener("input",(e)=>{
                    if(inputJam1.value >= 23 ){
                        alert("Jam Operasional 10:00 - 23:00");
                        inputJam1.value = "";
                    }

                    

                    if(inputJam1.value.length == 2){
                        for (let i = 0; i < jamMulai.length; i++) {
                            if(inputJam1.value > jamMulai[i] && inputJam1.value < jamAkhir[i]){
                                alert("Sudah ada yang memesan pada waktu tersebut");
                                inputJam1.value = "";
                            }

                            if(inputJam1.value == jamMulai[i]){
                                alert("Sudah ada yang memesan pada waktu tersebut");
                                inputJam1.value = "";
                            }
                            
                        } 
                        if(inputJam1.value <= time){
                            alert("Waktu Sudah Berlalu");
                            inputJam1.value = "";
                        }
                    }
                });
                inputJam2.addEventListener("input",(e)=>{
                    if(inputJam2.value  > 23 ){
                        alert("Jam Operasional 10:00 - 23:00");
                        inputJam2.value = "";
                    }
                    if(inputJam2.value.length == 2){
                        if(inputJam2.value < inputJam1.value){
                            alert("Tidak boleh kurang dari jam Awal");
                            inputJam2.value = '';
                        }

                        if(inputJam2.value  === inputJam1.value){
                            alert("Waktu reservasi Minimal 1 jam");
                            inputJam2.value = '';
                        }

                    
                        for (let i = 0; i < jamMulai.length; i++) {
                            if(inputJam1.value > jamMulai[i] && inputJam1.value < jamAkhir[i]){
                                alert("Sudah ada yang memesan pada waktu tersebut");
                                inputJam2.value = '';
                            }
                            
                            if(inputJam2.value == jamAkhir[i]){
                                alert("Sudah ada yang memesan pada waktu tersebut");
                                inputJam2.value = '';
                            }
                        }
                        if(inputJam2.value <= time){
                            alert("Waktu Sudah Berlalu");
                            inputJam2.value = "";
                        } 
                    }
                });
            }else{
                alert("Anda Tidak Mempunyai Akses");
                window.location = 'index.php';
                document.querySelector('.modal').hidden = true;
            }
              
          }
      })
  }