angular
.module('app')
.factory('reportesService', [
  '$log',
  '$http',
  '$auth',
  '$q',
  reportesService,
]);

function reportesService($log, $http, $auth, $q) {

  function getReportes() {
    var myChartObject = {
      inscriptos: {
        data: null,
        type: null,
        options: null
      },
      asistentes: {
        data: null,
        type: null,
        options: null
      },
    };
    var dfd = $q.defer();

    myChartObject.inscriptos.type = "BarChart";
    
    onions = [
        {v: "Onions"},
        {v: 3},
    ];

    myChartObject.inscriptos.data = {"cols": [
        {id: "t", label: "Topping", type: "string"},
        {id: "s", label: "Slices", type: "number"}
    ], "rows": [
        {c: [
            {v: "Mushrooms"},
            {v: 3},
        ]},
        {c: onions},
        {c: [
            {v: "Olives"},
            {v: 31}
        ]},
        {c: [
            {v: "Zucchini"},
            {v: 1},
        ]},
        {c: [
            {v: "Pepperoni"},
            {v: 2},
        ]}
    ]};

    myChartObject.inscriptos.options = {
        'title': 'Cantidad de inscriptos'
    };
    

    myChartObject.asistentes.type = "BarChart";
    
    onions = [
        {v: "Onions"},
        {v: 3},
    ];

    myChartObject.asistentes.data = {"cols": [
        {id: "t", label: "Topping", type: "string"},
        {id: "s", label: "Slices", type: "number"}
    ], "rows": [
        {c: [
            {v: "Mushrooms"},
            {v: 3},
        ]},
        {c: onions},
        {c: [
            {v: "Olives"},
            {v: 31}
        ]},
        {c: [
            {v: "Zucchini"},
            {v: 1},
        ]},
        {c: [
            {v: "Pepperoni"},
            {v: 2},
        ]}
    ]};

    myChartObject.asistentes.options = {
        'title': 'Cantidad de asistentes'
    };
    dfd.resolve({data: myChartObject});

    return dfd.promise;
    //desp descomentar la linea y borrar codigo y $q
    //return $http({ method: "GET", url: '/api/reports', cache: false });
  }

  const service = {
    getReportes,
  };

  return service;
}
