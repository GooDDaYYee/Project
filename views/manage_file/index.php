<div class="mx-4 my-4">
    <div id="elfinder"></div>
</div>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $("#elfinder").elfinder({
            cssAutoLoad: false,
            baseUrl: "./",
            url: "libs/elFinder/php/connector.minimal.php",
            resizable: false,
            height: "100%",
            defaultView: "list",
            sortType: "date",
            mimes: {
                all: true,
            },
            uiOptions: {
                toolbar: [
                    ["home", "back", "forward", "up", "reload"],
                    ["mkdir", "mkfile", "upload"],
                    ["open", "download", "getfile"],
                    ["undo", "redo"],
                    ["copy", "cut", "paste"],
                    ["rm", "empty"],
                    ["duplicate", "rename", "edit", "resize"],
                    ["extract", "archive"],
                    ["search"],
                    ["view", "sort"],
                ],
            },
        });
    });
</script>