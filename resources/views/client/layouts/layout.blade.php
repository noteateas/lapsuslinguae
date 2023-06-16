<!DOCTYPE html>
<html>
    <!-- include("client.components.loader.loader") -->

    @include("client.fixed.head")
    @include("client.fixed.header")

    @yield("content")

    @include("client.fixed.footer")

    @include("client.fixed.scripts")

    @yield("scripts")


</html>
