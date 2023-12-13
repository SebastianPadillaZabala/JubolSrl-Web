function generarGrafica(data) {
    const { label, data, data2, data3 } = data;
    const meses = [];
    const ingresos = new Array(label.length).fill(0);
    const comisiones = new Array(label.length).fill(0);
    const cash = new Array(label.length).fill(0);

    for (let i = 0; i < label.length; i++) {
        const fecha = new Date(label[i]);
        const mes = fecha.toLocaleString("default", { month: "long" });

        if (!meses.includes(mes)) {
            meses.unshift(mes);
        }

        const indiceMes = meses.indexOf(mes);
        ingresos[indiceMes] += parseFloat(data[i]);
        comisiones[indiceMes] += parseFloat(data2[i]);
        cash[indiceMes] += parseFloat(data3[i]);
    }

    const ctx = document.getElementById("grafica").getContext("2d");
    const chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: meses,
            datasets: [
                {
                    label: "Ingresos",
                    data: ingresos,
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Comisiones",
                    data: comisiones,
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Cash",
                    data: cash,
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                },
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}

function generarGrafica2(data) {
    const { label, data, data2 } = data;
    const formasDePago = [];
    const meses = [];
    const ingresosPorFOP = {};

    for (let i = 0; i < label.length; i++) {
        const fecha = new Date(label[i]);
        const mes = fecha.toLocaleString("default", { month: "long" });

        if (!meses.includes(mes)) {
            meses.push(mes);
        }

        const indiceMes = meses.indexOf(mes);
        const formaDePago = data2[i];

        if (!formasDePago.includes(formaDePago)) {
            formasDePago.push(formaDePago);
            ingresosPorFOP[formaDePago] = new Array(meses.length).fill(0);
        }

        ingresosPorFOP[formaDePago][indiceMes] += parseFloat(data[i]);
    }

    const colores = [
        "rgba(75, 192, 192, 0.2)",
        "rgba(255, 99, 132, 0.2)",
        "rgba(54, 162, 235, 0.2)",
    ];
    const ctx = document.getElementById("graficaFOP").getContext("2d");
    const chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: meses,
            datasets: formasDePago.map((fop, index) => ({
                label: fop,
                data: ingresosPorFOP[fop],
                backgroundColor: colores[index % colores.length],
                borderColor: colores[index % colores.length],
                borderWidth: 1,
            })),
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                },
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}


