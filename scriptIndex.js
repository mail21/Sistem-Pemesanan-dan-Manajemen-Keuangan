$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  console.log(tipe);

  

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
            
              let	isi =`
<h3>Meja Masih kosong</h3>
<button type="button" class="btn btn-secondary reservasiToggle">Reservasi</button>
<a href="menu.php"><button type="button" class="btn btn-primary">Pesan</button></a>
<div class="formReservasi" hidden>
  <form action="reservasi.php" method="POST">
      <input type="hidden" name="id" value="${id_meja}">
      <label for="no">Jam:</label>
      <input name="jam" type="text" class="form-control inputWaktu mt-3" placeholder="Jam" id="no">
      <input name="menit" type="text" class="form-control inputWaktu mt-3" placeholder="Menit">
      <br>
      <label for="nama">Nama</label>
      <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Pelanggan">
      <label for="no">No Telepon</label>
      <input name="no" type="text" class="form-control" id="no" placeholder="Nomor Telepon">
      <button name="submit" class="btn btn-primary mt-3">submit</button>
  </form>
</div>`; 
              modalBody.innerHTML = isi;
              modalTitle.textContent = `Meja ${id_meja}`;
              let reservasiToggle = document.querySelector(".reservasiToggle")
              reservasiToggle.addEventListener('click', function(){
                if(tipe === "Kasir" || tipe === "Pelanggan" ){
                  document.querySelector(".formReservasi").toggleAttribute('hidden');
                }else{
                    alert("Anda Tidak Mempunyai Akses");
                    window.location = 'index.php';
                    document.querySelector('.modal').hidden = true;
                }
              })
          }else if(statusMeja == "aktif"){
            if(tipe === "Pelanggan" ){
                alert("Anda Tidak Mempunyai Akses");
                window.location = 'index.php';
                document.querySelector('.modal').hidden = true;
            }
              document.querySelector('.modal-dialog').classList.add('modal-lg');
              let data = await row.dataset.menu;
              console.log(id_meja)
              console.log(data);
              data = data.replace(/\'/g, '"');
              const menu = JSON.parse(data);
              modalTitle.textContent = `Meja ${id_meja}`;
              let isi = `
      <form action="cetakStruk.php" method="POST">
      <a href="menu.php"><button type="button" class="btn btn-primary mb-3">Pesan</button></a>
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
            if(tipe === "Pelanggan" ){
                alert("Anda Tidak Mempunyai Akses");
                window.location = 'index.php';
                document.querySelector('.modal').hidden = true;
            }
              let nama_pelanggan = await row.dataset.pelanggan;
              modalTitle.textContent = `Meja ${id_meja}`;
              let	isi =`
      <h3>Meja Reservasi Milik ${nama_pelanggan}</h3>
      <a href="menu.php"><button type="button" class="btn btn-primary">Pesan</button></a>
      <a href="kosong.php?nama='${nama_pelanggan}'"><button type="button" class="btn btn-primary">Kosongkan</button></a>`;
              modalBody.innerHTML = isi;
          }
      })
  }