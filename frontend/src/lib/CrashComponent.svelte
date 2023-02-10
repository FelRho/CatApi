<script>
  import { onMount } from "svelte";
    export let chrashed = false;

</script>

<div class="blue-screen">
    <p>A fatal exception 0E76534801 has occured at 0027:C871231 in VXD VMM.</p>
    <p>Operating system has been stopped to prevent damage to your computer.</p>
    <br>
    <p>* Press any key to terminate this application.</p>
    <p>* Press CTRL+ALT+DELETE to restart your computer.</p>
    <p>  You will lose any unsaved information in all applications.</p>
    <br>
    <br>
    <p>Press any key to continue _</p>
    <button on:click={() => {chrashed = false}}>Test</button>
</div>

<style>
    .blue-screen {
        color: white;
        text-align: left;
        font-size: 28px;
    }
</style>