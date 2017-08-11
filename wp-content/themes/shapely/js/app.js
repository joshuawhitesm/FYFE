jQuery(document).ready(function($) {
  var ajaxUrl = $("[data-name=admin-ajax]").data("url");

  function cat_ajax_get(catID) {
    $("a.ajax").removeClass("current");
    $("a.ajax").addClass("current"); //adds class current to the category menu item being displayed so you can style it with css
    $("#loading-animation").show();
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: { action: "load-filter", cat: catID, refresh_cart: "yes" },
      success: function(response) {
        $("#category-post-content").html(response);
        $("#loading-animation").hide();
        return false;
      }
    });
  }

  function location_ajax_get(postID) {
    $("a.ajax").removeClass("current");
    $("a.ajax").addClass("current"); //adds class current to the category menu item being displayed so you can style it with css
    $("#loading-animation").show();
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: { action: "load_location", location_cat: catID },
      success: function(response) {
        $("#location-content").html(response);
        $("#loading-animation").hide();
        return false;
      }
    });
  }

  function loadMoreProjects() {
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
  }

  function jump(e) {
    if (e) {
      var target = $(this).attr("href");
    } else {
      var target = location.hash;
    }

    // Target must be longer than "#"
    if (target.length > 1) {
      e.preventDefault();

      $("html,body").animate(
        {
          scrollTop: $(target).offset().top - 80
        },
        2000,
        function() {
          location.hash = target;
        }
      );
    }
  }

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
    ).success(function(html) {
      $("#project_our_ajax").html("");
      $("#project_our_ajax").append(html);
    });
  });

  $(".name_sectors h6").on("click", function() {
    var name_services = $(".name_services_hidden").val();
    var name_sectors = $(".name_sectors_hidden").val();
    console.log(ajaxUrl);
    console.log(name_services);
    console.log(name_sectors);
    $.post(
      ajaxUrl,
      {
        action: "project_our_ajax",
        name_services: name_services,
        name_sectors: name_sectors
      },
      "html"
    ).success(function(html) {
      $("#project_our_ajax").html("");
      $("#project_our_ajax").append(html);
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
    ).success(function(html) {
      $("#project_our_ajax").html("");
      $("#project_our_ajax").append(html);
    });
  });

  if ($(".infinite-container").length > 0) {
    var infinite = new Waypoint.Infinite({
      element: $(".infinite-container")[0]
    });

    var waypoint = new Waypoint({
      element: $(".infinite-container")[0],
      handler: function(direction) {
        console.log("Scrolled to waypoint!");
      }
    });
  }

  var $loading = $("#loadingDiv").hide();
  $(document)
    .ajaxStart(function() {
      $loading.show();
    })
    .ajaxStop(function() {
      $loading.hide();
    });

  $(".sliderhome_75370").on("click", function() {
    $("html,body").animate(
      { scrollTop: $("#contact_home_bottom").offset().top - 80 },
      "slow"
    );
  });

  $(".click_top_scroll").on("click", function() {
    $("html,body").animate(
      { scrollTop: $("#sesion_2_home_fyfe_project ").offset().top - 80 },
      "slow"
    );
  });

  $("#category-menu").on("click", ".init", function() {
    $(this).closest("#category-menu").children("li:not(.init)").toggle();
  });

  var allOptions = $("#category-menu").children("li:not(.init)");
  $("#category-menu").on("click", "li:not(.init)", function() {
    allOptions.removeClass("selected");
    $(this).addClass("selected");
    $("#category-menu").children(".init").html($(this).html());
    allOptions.toggle();
  });

  $("#category-menu2").on("click", ".init2", function() {
    $(this).closest("#category-menu2").children("li:not(.init2)").toggle();
  });

  var allOptions2 = $("#category-menu2").children("li:not(.init2)");
  $("#category-menu2").on("click", "li:not(.init2)", function() {
    allOptions2.removeClass("selected");
    $(this).addClass("selected");
    $("#category-menu2").children(".init2").html($(this).html());
    allOptions2.toggle();
  });

  $(".name_sectors-title").click(function() {
    $(".name_sectors-item").toggle(500);
  });

  $(".name-services-title").click(function() {
    $(".name_services-fix").toggle(500);
  });

  $(".carousel").carousel();

  $(".glr-right img").hover(
    function() {
      $(".slhome_des").css("display", "block");
    },
    function() {
      $(".slhome_des").css("display", "none");
    }
  );

  $(".slhome_des").hover(
    function() {
      $(this).css("display", "block");
    },
    function() {
      $(this).css("display", "none");
    }
  );

  $("a[href^=#]").bind("click", jump);

  if (location.hash) {
    setTimeout(function() {
      $("html, body").scrollTop(0).show();
      jump();
    }, 0);
  } else {
    $("html, body").show();
  }
});
