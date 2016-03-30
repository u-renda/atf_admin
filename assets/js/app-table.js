$(function () {
    // Admin Lists
    $("#grid_admin_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "admin_get",
                    dataType: "json"
                }
            },
            schema: {
                data: "data",
                total: "total"
            },
            pageSize: 20
        },
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        columns: [
            {
                field: "No",
                width: 40,
                sortable: false
            }, {
                field: "Name"
            }, {
                field: "Email"
            }, {
                field: "Username"
            }, {
                field: "AdminRole",
                title: "Admin Role"
            }, {
                field: "Action",
                template: "#= data.Action #",
                sortable: false
            }
        ]
    });
    
    // Movie Lists
    $("#grid_movie_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "movie_get",
                    dataType: "json"
                }
            },
            schema: {
                data: "data",
                total: "total"
            },
            pageSize: 20
        },
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        columns: [
            {
                field: "No",
                width: 40,
                sortable: false
            }, {
                field: "Title"
            }, {
                field: "Photo",
                template: "#= data.Photo #"
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 150,
                sortable: false
            }
        ]
    });
    
    // Movie Cast Lists
    $("#grid_movie_cast_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "movie_cast_get",
                    dataType: "json"
                }
            },
            schema: {
                data: "data",
                total: "total"
            },
            pageSize: 20
        },
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        columns: [
            {
                field: "No",
                width: 40,
                sortable: false
            }, {
                field: "Actor",
                title: "Cast (Actor Name)",
                template: "#= data.Actor #"
            }, {
                field: "Movie"
            }, {
                field: "Photo",
                template: "#= data.Photo #"
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 100,
                sortable: false
            }
        ]
    });
    
    // Product Lists
    $("#grid_product_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "product_get",
                    dataType: "json"
                }
            },
            schema: {
                data: "data",
                total: "total"
            },
            pageSize: 20
        },
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        columns: [
            {
                field: "No",
                width: 40,
                sortable: false
            }, {
                field: "Name",
                template: "#= data.Name #"
            }, {
                field: "Price"
            },{
                field: "MovieTitle",
                title: "Movie Title"
            }, {
                field: "ProductBrand",
                title: "Product Brand"
            }, {
                field: "Photo",
                template: "#= data.Photo #"
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 100,
                sortable: false
            }
        ]
    });
    
    // Product Brand Lists
    $("#grid_product_brand_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "product_brand_get",
                    dataType: "json"
                }
            },
            schema: {
                data: "data",
                total: "total"
            },
            pageSize: 20
        },
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        columns: [
            {
                field: "No",
                width: 40,
                sortable: false
            }, {
                field: "Name"
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 100,
                sortable: false
            }
        ]
    });
    
    // Product Category Lists
    $("#grid_product_category_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "product_category_get",
                    dataType: "json"
                }
            },
            schema: {
                data: "data",
                total: "total"
            },
            pageSize: 20
        },
        sortable: true,
        pageable: {
            refresh: true,
            pageSizes: true,
            buttonCount: 5
        },
        columns: [
            {
                field: "No",
                width: 40,
                sortable: false
            }, {
                field: "Name"
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 100,
                sortable: false
            }
        ]
    });
});