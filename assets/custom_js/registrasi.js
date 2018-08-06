/*
Created by: Xaverius Najoan
*/


function enableSubmit(val) {
	var check = document.getElementById("start");

	if (val.checked == true) {
		check.disabled = false;
	} else {
		check.disabled = true;
	}
}

function changeEqRumah(radio) {
	var kode = radio.value;
	document.getElementById('alamatManado').disabled = false;
	
	if (kode == 0) {
	
	document.getElementById('alamatManado').value = document.getElementById('alamat').value;
	
	} else {
	document.getElementById('alamatManado').value ="";
	}
}

function changeEqRumahOrtu(radio) {
	var kode = radio.value;
	document.getElementById('alamatOrtu').disabled = false;
	
	if (kode == 0) {
	
	document.getElementById('alamatOrtu').value = document.getElementById('alamat').value;
	
	} else {
	document.getElementById('alamatOrtu').value ="";
	}
}

function changeWali() {
	var kode = $("input[type='radio'][id='wali']:checked").val();
	
	if (kode == 0) {
	
		document.getElementById('nama_wali').disabled = false;
		document.getElementById('tempat_lahir_wali').disabled = false;
		document.getElementById('tanggal_lahir_wali').disabled = false;
		document.getElementById('pekerjaan_wali').disabled = false;
		document.getElementById('pendidikan_wali').disabled = false;
		document.getElementById('telp_wali').disabled = false;
	
	} else {
		document.getElementById('nama_wali').value = "";
		document.getElementById('tempat_lahir_wali').value = "";
		document.getElementById('tanggal_lahir_wali').value = "";
		document.getElementById('pekerjaan_wali').value = "";
		document.getElementById('pendidikan_wali').value = "";
		document.getElementById('telp_wali').value = "";
		
		document.getElementById('nama_wali').disabled = true;
		document.getElementById('tempat_lahir_wali').disabled = true;
		document.getElementById('tanggal_lahir_wali').disabled = true;
		document.getElementById('pekerjaan_wali').disabled = true;
		document.getElementById('pendidikan_wali').disabled = true;
		document.getElementById('telp_wali').disabled = true;
	}
}