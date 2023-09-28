import { getRoot } from "./functions";

$(document).ready(function () {
  $("#formAdd").on("submit", (e) => {
    e.preventDefault();

    let data = {
      adicionar: $("#Add").val(),
    };

    if (data.adicionar == "") {
      alert("preencha o formulario");
      return;
    }
    $.ajax({
      type: "POST",
      url: getRoot() + "Atividade_Avaliativa/controller/utils/preencherFila",
      data: data,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          alert("Item " + response.item + "  adicionado à fila");
          window.location.reload();
        } else {
          alert("Falha ao adicionar " + response.item + " à fila");
          window.location.reload();
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        console.error(status);
        console.error(error);
      },
    });
  });

  $("#formRemove").on("submit", (e) => {
    e.preventDefault();

    let data = {
      remover: $("#remover").val(),
    };

    $.ajax({
      type: "POST",
      url: getRoot() + "Atividade_Avaliativa/controller/utils/esvaziarFila",
      data: data,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#resultado").empty();
          $.each(response.items, function (index, item) {
            $("#resultado").append(
              "ID: " + item.ID + " - Data: " + item.Data + "<br>"
            );
          });
          alert("Itens removidos com sucesso.");
          window.location.reload();
        } else {
          alert("Falha ao remover itens da fila.");
          window.location.reload();
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        console.error(status);
        console.error(error);
      },
    });
  });
});
