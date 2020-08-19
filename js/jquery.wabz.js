/**
 * To Do:
 * - Add the woocommerce loading spinner
 * - Implement a more friendly manner to display errors than JS ugly alert
 * - Add custom error messages from backend
 */
jQuery(document).ready(function ($) {
  function clearZip() {
    $("#billing_address_1").val("");
    $("#billing_neighborhood").val("");
    $("#billing_city").val("");
    $("#select2-billing_state-container").val("");
    $("#select2-billing_state-container").html("");
    $("#select2-billing_state-container").prop("title", "");
  }

  //Quando o campo cep perde o foco.
  $("#billing_postcode").blur(function () {
    //Nova variável "cep" somente com dígitos.
    var zip = $(this).val().replace(/\D/g, "");

    //Verifica se campo cep possui valor informado.
    if (zip != "") {
      //Expressão regular para validar o CEP.
      var validateZip = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validateZip.test(zip)) {

        // Limpar formulário
        clearZip();

        //Consulta o webservice viacep.com.br/
        $.getJSON(
          "https://viacep.com.br/ws/" + zip + "/json/?callback=?",
          function (data) {
            if (!("erro" in data)) {
              console.log(data);
              //Atualiza os campos com os valores da consulta.
              $("#billing_address_1").val(data.logradouro);
              $("#billing_neighborhood").val(data.bairro);
              $("#billing_city").val(data.localidade);
              $("#billing_state").val(data.uf).change();
            } //end if.
            else {
              //CEP pesquisado não foi encontrado.
              clearZip();
              console.log("Address not found.");
            }
          }
        );
      } //end if.
      else {
        //cep é inválido.
        clearZip();
        console.log("Invalid ZIP format");
      }
    } //end if.
    else {
      //cep sem valor, limpa formulário.
      clearZip();
    }

    // stop loading

  });
});
