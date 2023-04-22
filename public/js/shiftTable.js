// シフト表の作成
document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.querySelector("#shiftTable tbody");
    const startDate = new Date("2023-04-01");
    const endDate = new Date("2023-04-30");
    const shiftData = [
      // 日付と従業員ごとのシフトデータ
      { date: "2023-04-07", employee1: "出勤", employee2: "" },
      { date: "2023-04-08", employee1: "", employee2: "出勤" },
      // 他の日付のデータを追加
    ];
  
    const employees = [
      "従業員A",
      "従業員B",
      "従業員C",
      "従業員D",
      "従業員E",
    ];
  
    let currentDate = startDate;
    while (currentDate <= endDate) {
      const dateString = currentDate.toISOString().slice(0, 10);
      const row = document.createElement("tr");
      const dateCell = document.createElement("td");
      dateCell.textContent = dateString.slice(5);
      row.appendChild(dateCell);
  
      employees.forEach((employee) => {
        const rowData = shiftData.find(
          (row) => row.date === dateString && row[employee]
        );
        const cell = document.createElement("td");
        if (rowData && rowData[employee] === "出勤") {
          cell.textContent = "〇";
        }
        row.appendChild(cell);
      });
  
      tableBody.appendChild(row);
      currentDate.setDate(currentDate.getDate() + 1);
    }
  
    // CSV出力機能
    document.getElementById("exportCsv").addEventListener("click", function () {
      let csvContent = "data:text/csv;charset=utf-8,";
      const tableRows = document.querySelectorAll("#shiftTable tr");
  
      tableRows.forEach(function (row, index) {
        const rowData = [];
        row
          .querySelectorAll("td, th")
          .forEach(function (cell) {
            rowData.push(cell.textContent);
          });
        csvContent += rowData.join(",") + (index < tableRows.length - 1 ? "\n" : "");
      });
  
      // CSVファイルをダウンロード
      const encodedUri = encodeURI(csvContent);
      const link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", "shifts.csv");
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });
  });