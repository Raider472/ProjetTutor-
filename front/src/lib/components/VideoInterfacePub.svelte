<script lang="ts">
    export let source: string
    export let videoExtension: string
</script>

<video width="800" height="600" controls autoplay>
    <source src={source} type=video/{videoExtension}>
</video>