jQuery(document).ready(function($) {
  var ajaxUrl = $("[name=admin-ajax]").data("url")
  $(".name_services h6").on("click", function() {
    var name_services = $(".name_services_hidden").val();
    var name_sectors = $(".name_sectors_hidden").val();
    $.post(
      ajaxUrl,
      {
        action: "project_our_ajax",
        name_services: name_services,
        name_sectors: name_sectors
      },
      "html"
    ).success(function(posts1345) {
      $("#project_our_ajax").html("");
      $("#project_our_ajax").append(posts1345);
    });
  });

  $(".name_sectors h6").on("click", function() {
    var name_services = $(".name_services_hidden").val();
    var name_sectors = $(".name_sectors_hidden").val();
    $.post(
      ajaxUrl,
      {
        action: "project_our_ajax",
        name_services: name_services,
        name_sectors: name_sectors
      },
      "html"
    ).success(function(posts1345) {
      $("#project_our_ajax").html("");
      $("#project_our_ajax").append(posts1345);
    });
  });

  $(".style_project_our_top1_all").on("click", function() {
    var name_services = "all";
    var name_sectors = "all";
    $(".name_services_hidden").val("all");
    $(".name_sectors_hidden").val("all");
    $(".name_sectors h6").removeClass("current_cat");
    $(".name_services h6").removeClass("current_cat");
    $.post(
      ajaxUrl,
      {
        action: "project_our_ajax",
        name_services: name_services,
        name_sectors: name_sectors
      },
      "html"
    ).success(function(posts1345) {
      $("#project_our_ajax").html("");
      $("#project_our_ajax").append(posts1345);
    });
  });

  var loadMoreProjects = function() {
    console.log("loading........");
    // var paged = $('.ajax_posts_f_page').last().val()
    var paged = $(".ajax_posts_f_page_project").last().val();
    var name_services = $(".name_services_hidden").val();
    var name_sectors = $(".name_sectors_hidden").val();
    $.post(
      $(this).data("url"),
      {
        action: "see_more_project_our_ajax",
        paged: paged,
        name_services: name_services,
        name_sectors: name_sectors
      },
      "html"
    ).success(function(html) {
      $("#project_our_ajax").append(html);
    });
  };

  // $("#read_more_project").on("click", loadMoreProjects);
  if ($(".infinite-container").length > 0) {
    var infinite = new Waypoint.Infinite({
      element: $(".infinite-container")[0]
    });

    var waypoint = new Waypoint({
      element: $(".infinite-container")[0],
      handler: function(direction) {
        console.log('Scrolled to waypoint!')
      }
    })
  }

  // $("#project_our_ajax").jscroll({
  //   debug: true,
  //   loadingFunction: loadMoreProjects,
  //   padding: 20,
  //   nextSelector: "a.jscroll-next:last",
  //   contentSelector: ".project"
  // });
});
