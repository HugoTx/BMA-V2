//***************** POR DISCIPLINA ************************** -->
$(document).ready(function () {
  $('#procurarDisciplina').click(function () {
    $('#novaPesquisa tbody').find('tr').remove();
    var disc = $('#disciplina').val();
    $.getJSON(
      'includes/APIsumarios.php?acao=listaSumarios&disciplina=' + disc,
      function (listaSumarios) {
        for (x = 0; x < listaSumarios.disciplinas.length; x++) {
          var row = listaSumarios.disciplinas[x];
          var sumarios =
            '<tr id="linha" class="table-light">' +
            '<td class="text-center align-middle" id="licao">' +
            row.licao +
            '</td>' +
            '<td class="text-center align-middle" id="dataaula">' +
            row.dataaula +
            '</td>' +
            '<td class="text-center align-middle" id="turma_aluno">' +
            row.turma_aluno +
            '</td>' +
            '<td class="text-center align-middle" id="nomeAnimal">' +
            row.disciplina +
            '</td>' +
            '<td class="text-center align-middle" id="telefone">' +
            row.sumario +
            '</td>' +
            '</tr>';
          $('#novaPesquisa').find('tbody').append(sumarios);
        }
      }
    );
  });
});

//********** POR TURMA / ALUNO ***************-->
$(document).ready(function () {
  $('#procurarAluno').click(function () {
    $('#novaPesquisa tbody').find('tr').remove();
    var nome = $('#nome').val();
    $.getJSON(
      'includes/APIsumarios.php?acao=listaSumariosaluno&nome=' + nome,
      function (listaSumariosaluno) {
        for (x = 0; x < listaSumariosaluno.alunos.length; x++) {
          var row = listaSumariosaluno.alunos[x];
          var sumarios =
            '<tr id="linha" class="table-light">' +
            '<td class="text-center align-middle" id="licao">' +
            row.licao +
            '</td>' +
            '<td class="text-center align-middle" id="dataaula">' +
            row.dataaula +
            '</td>' +
            '<td class="text-center align-middle" id="turma_aluno">' +
            row.turma_aluno +
            '</td>' +
            '<td class="text-center align-middle" id="nomeAnimal">' +
            row.disciplina +
            '</td>' +
            '<td class="text-center align-middle" id="telefone">' +
            row.sumario +
            '</td>' +
            '</tr>';
          $('#novaPesquisa').find('tbody').append(sumarios);
        }
      }
    );
  });
});

// ********** DISCIPLINAS POR DATA *************** -->
$(document).ready(function () {
  $('#procurarDisciplinaData').click(function () {
    $('#novaPesquisa tbody').find('tr').remove();
    var dataIn = $('#dataInicio').val();
    var dataF = $('#dataFim').val();
    var dis = $('#disciplinaData').val();
    $.getJSON(
      'includes/APIsumarios.php?acao=listaSumariosDataDisciplina&dataIni=' +
        dataIn +
        '&dataFim=' +
        dataF +
        '&disciplina=' +
        dis,
      function (listaSumariosDataDisciplina) {
        for (x = 0; x < listaSumariosDataDisciplina.disciplinas.length; x++) {
          var row = listaSumariosDataDisciplina.disciplinas[x];
          var sumarios =
            '<tr id="linha" class="table-light">' +
            '<td class="text-center align-middle" id="licao">' +
            row.licao +
            '</td>' +
            '<td class="text-center align-middle" id="dataaula">' +
            row.dataaula +
            '</td>' +
            '<td class="text-center align-middle" id="turma_aluno">' +
            row.turma_aluno +
            '</td>' +
            '<td class="text-center align-middle" id="nomeAnimal">' +
            row.disciplina +
            '</td>' +
            '<td class="text-center align-middle" id="telefone">' +
            row.sumario +
            '</td>' +
            '</tr>';
          $('#novaPesquisa').find('tbody').append(sumarios);
        }
      }
    );
  });
});

// ********** ALUNOS POR DATA *************** -->
$(document).ready(function () {
  $('#procurarAlunoData').click(function () {
    $('#novaPesquisa tbody').find('tr').remove();
    var dataIn = $('#dataInicioAluno').val();
    var dataF = $('#dataFimAluno').val();
    var nome = $('#nomeAlunoData').val();
    console.log(dataIn, dataF, nome);
    $.getJSON(
      'includes/APIsumarios.php?acao=listaSumariosDataAluno&dataIni=' +
        dataIn +
        '&dataFim=' +
        dataF +
        '&nome=' +
        nome,
      function (listaSumariosDataAluno) {
        for (x = 0; x < listaSumariosDataAluno.disciplinas.length; x++) {
          var row = listaSumariosDataAluno.disciplinas[x];
          var sumarios =
            '<tr id="linha" class="table-light">' +
            '<td class="text-center align-middle" id="licao">' +
            row.licao +
            '</td>' +
            '<td class="text-center align-middle" id="dataaula">' +
            row.dataaula +
            '</td>' +
            '<td class="text-center align-middle" id="turma_aluno">' +
            row.turma_aluno +
            '</td>' +
            '<td class="text-center align-middle" id="nomeAnimal">' +
            row.disciplina +
            '</td>' +
            '<td class="text-center align-middle" id="telefone">' +
            row.sumario +
            '</td>' +
            '</tr>';
          $('#novaPesquisa').find('tbody').append(sumarios);
        }
      }
    );
  });
});

// Mostrar a table com os sumários
function alterClass() {
  const tableClass = document.getElementById('table_sumario');

  tableClass.classList.remove('d-none');
}

// Exportar para Excel ****************************************************************
function exportTableToExcel(tableId, filename = 'tabela_excel') {
  var wb = XLSX.utils.table_to_book(document.getElementById(tableId), {
    sheet: 'Sheet JS',
  });
  var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

  function s2ab(s) {
    var buf = new ArrayBuffer(s.length);
    var view = new Uint8Array(buf);
    for (var i = 0; i < s.length; i++) {
      view[i] = s.charCodeAt(i) & 0xff;
    }
    return buf;
  }

  var blob = new Blob([s2ab(wbout)], { type: 'application/octet-stream' });

  var link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = filename + '.xlsx';
  link.click();
}