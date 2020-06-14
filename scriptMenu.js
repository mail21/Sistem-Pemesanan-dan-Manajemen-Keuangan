$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

    

  
  let menuRows = document.querySelectorAll(".menu");
  for (const menuRow of menuRows) {
    
      
       menuRow.addEventListener("click",async (e)=>{
        if(tipe === "Pelanggan" || tipe === "Kasir" || tipe === "Admin" ){
            alert("Hanya bisa melihat");
            window.location = 'menu.php';
            document.querySelector('.modal').hidden = true;
        }
          const modalBody = document.querySelector('.modal-body');
          // =========================== get menu =======================
          let targetParent = e.target.parentElement
          let menuStr = e.target.innerText.split("\n");
          if(targetParent.tagName == "DIV" && menuStr.length === 1){
              //jika yang diklik harga,namaMakanan,nomor
              menuStr = targetParent.innerText.split("\n");
          }else if(targetParent.tagName == "MENU-ITEM"){
              //jika yang diklik gambar
              menuStr = targetParent.parentElement.innerText.split("\n");
          }
          // =========================== get menu =======================
          let noMeja = document.querySelector("#hiddenMeja");
          console.log("noMeja",noMeja);

          console.log("noMeja.value",noMeja.value);
          let strMejaValue = noMeja.value;
          strMejaValue = strMejaValue.replace(/\'/g, '"');
          const dataMeja = JSON.parse(strMejaValue);
          let str2 = ""
          for ( let strDataMeja of dataMeja){
              if(strDataMeja.nama_pelanggan != "kosong"){
                   str2 += `<option value='${strDataMeja.id_meja}'>${strDataMeja.id_meja} - ${strDataMeja.status} - ${strDataMeja.nama_pelanggan} </option>`;
              }else{
                  str2 += `<option value='${strDataMeja.id_meja}'>${strDataMeja.id_meja} - ${strDataMeja.status}</option>`
              }	
          }
           let isi2 = `
      <form action="tambahPesanan.php" method="POST">
          <h4>${menuStr[1]}, <span class="harga">${menuStr[2]}</span></h4>
          <input type="hidden" name="idMenu" value="${menuStr[0]}">
          <input type="hidden" name="harga" value="${menuStr[2]}">
          <div class="form-group mr-3 ml-3">
              <label for="nomorMeja">No Meja</label>
              <select name="nomorMeja" class="form-control" id="nomorMeja">
              ${str2}
              </select>
          </div>
          <div class="form-group mr-3 ml-3">
              <label for="exampleFormControlTextarea1">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" id="deskripsiText" rows="3"></textarea>
          </div>
          <div id="input_div">
              <span class="btnInput minus mr-2">-</span>
              <input type="text" name="quantity" readonly value="1" id="count">
              <span class="btnInput plus ml-2">+</span>
          </div>
          <center>
              <input type="text" name="total" readonly value="${menuStr[2]}" id="total">
          </center>
          <br>
          <button type="button" class="btn buttonSubmit btn-secondary btn-lg" data-dismiss="modal">Close</button>
          <button name="pesan" type="submit" class="btn buttonSubmit btn-primary btn-lg">Pesan</button>
      </form>`
               modalBody.innerHTML = isi2;

          let selectTag = document.querySelector("#nomorMeja")
          console.log(selectTag)
          selectTag.addEventListener("change",(e)=>{
              console.log(e.target.value)
           })
           let count = 1;
           let countTotal = document.getElementById("total");
           let countEl = document.getElementById("count");
           let harga = parseInt(menuStr[2].replace(/RP./gi, ""));
           const plus = document.querySelector('.plus')
           plus.addEventListener("click", ()=>{
               count++;
               countTotal.value = "Rp." + harga * count;
               countEl.value = count;
           });
           const minus = document.querySelector('.minus');
           minus.addEventListener("click", ()=>{
              if (count > 1) {
                   count--;
                   countTotal.value = "Rp." + harga * count;
                   countEl.value = count;
                   if(count == 0){
                      countTotal.value = "Rp." + harga;
                   }
              }
          })
        
       }) 
    
}