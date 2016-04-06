$(function () {
    resubmit_movie_cast();
    
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
                field: "ProductName",
                title: "Product Name",
                template: "#= data.ProductName #",
                width: 300
            }, {
                field: "Price",
                width: 100
            }, {
                field: "Photo",
                template: "#= data.Photo #",
                width: 200
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 150,
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
    
    // Member Lists
    $("#grid_member_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "member_get",
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
                field: "Gender",
                width: 100
            }, {
                field: "Birthday",
                width: 100
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 150,
                sortable: false
            }
        ]
    });
    
    // Member Love Lists
    $("#grid_member_love_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "member_love_get",
                    dataType: "json",
                    data: {
                        id_member : $('#id_member').val(),
                        id_product : $('#id_product').val()
					}
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
                field: "MemberName",
                title: "Member Name"
            }, {
                field: "ProductName",
                title: "Product Name"
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 150,
                sortable: false
            }
        ]
    });
    
    // Member Wishlist Lists
    $("#grid_member_wishlist_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "member_wishlist_get",
                    dataType: "json",
                    data: {
                        id_member : $('#id_member').val(),
                        id_product : $('#id_product').val()
					}
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
                field: "MemberName",
                title: "Member Name"
            }, {
                field: "ProductName",
                title: "Product Name"
            }, {
                field: "Action",
                template: "#= data.Action #",
                width: 150,
                sortable: false
            }
        ]
    });
});

// Movie Cast Lists
function resubmit_movie_cast() {
    $("#grid_movie_cast_lists").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: newPathname + "movie_cast_get",
                    dataType: "json",
                    type: "POST",
					data: {
                        id_movie : $('#id_movie').val()
					}
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
}

$('#form-movie-cast-lists').submit(function (){
    resubmit_movie_cast();
    $('#grid_movie_cast_lists').data('kendoGrid').dataSource.read();
    $('#grid_movie_cast_lists').data('kendoGrid').refresh();
    return false;
});