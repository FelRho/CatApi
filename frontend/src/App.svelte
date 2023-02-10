<script>
  import { onMount } from "svelte";
  import ChangeVersion from "./lib/ChangeVersionComponent.svelte";
  import CrashComponent from "./lib/CrashComponent.svelte";
  import app from "./main";

  const StyleStorage = "IsXpStyle";
  let styleXp = true;
  let updateVisible = false;
  let crash = false;

  let component;
  let styles = {
    Windowsxp: () => import("xp.css/dist/XP.css"),
    Windows98: () => import("xp.css/dist/98.css"),
  };

  onMount(() => {
    readAndApplyStyle();
  });

  function readAndApplyStyle() {
    styleXp = localStorage.getItem(StyleStorage) === "true";

    if (styleXp) {
      component = styles.Windowsxp;
      document.body.classList.add("xp-bg");
    } else {
      component = styles.Windows98;
      document.body.classList.add("windows-bg");
    }

    component.apply();
  }

  function changeStyle() {
    styleXp = !styleXp;

    localStorage.setItem(StyleStorage, styleXp.toString());

    location.reload();
  }

  function crashApp() {
    crash = true;

    document.body.classList.remove("xp-bg");
    document.body.classList.remove("windows-bg");

    document.body.classList.add("crash-bg");
  }

  $: if (crash) {
    document.body.classList.remove("xp-bg");
    document.body.classList.remove("windows-bg");

    document.body.classList.add("crash-bg");
  } else {
    readAndApplyStyle();
  }
</script>

<main>
  {#if crash}
    <CrashComponent bind:chrashed={crash} />
  {:else}
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="window window-size">
            <div class="title-bar">
              <div class="title-bar-text">Cat API</div>
              <div class="title-bar-controls">
                <button
                  aria-label="Help"
                  on:click={() => {
                    updateVisible = true;
                  }}
                />
                <button aria-label="Close" on:click={crashApp} />
              </div>
            </div>
            <div class="window-body">
              <p>Hello, world!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  {/if}
</main>

<ChangeVersion
  IsXpStyle={styleXp}
  on:click={changeStyle}
  bind:IsVisisble={updateVisible}
/>

<style>
  .window-size {
    height: 70vh;
    width: 70vw;
  }
</style>
