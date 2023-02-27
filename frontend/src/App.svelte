<script>
  import { onMount } from "svelte";
  import ChangeVersion from "./lib/ChangeVersionComponent.svelte";
  import CrashComponent from "./lib/CrashComponent.svelte";
  import { tweened } from "svelte/motion";
  import { cubicOut } from "svelte/easing";

  const StyleStorage = "IsXpStyle";
  let styleXp = true;
  let updateVisible = false;
  let crash = false;
  let imageLoaded = false;

  let component;
  let styles = {
    Windowsxp: () => import("xp.css/dist/XP.css"),
    Windows98: () => import("xp.css/dist/98.css"),
  };

  onMount(() => {
    readAndApplyStyle();
  });

  const progress = tweened(0, {
    duration: 2000,
    easing: cubicOut,
  });

  onMount(() => {
    progress.set(1);
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
    console.log("Aaaa");
  }

  function loaded() {
    imageLoaded = true;
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
                <button aria-label="Minimize" />
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
              <section class="tabs">
                <menu role="tablist" aria-label="Sample Tabs">
                  <button
                    role="tab"
                    aria-controls="img-tab"
                    aria-selected="true"
                    >Tab A</button
                  >
                  <button
                    role="tab"
                    aria-controls="up-tab"
                    aria-selected="false"
                    >Tab B</button
                  >
                </menu>
                <!-- the tab content -->
                <article role="tabpanel" id="img-tab">
                  <div class="mb-2 mt-2">
                    <img
                      src="https://thecatapi.com/api/images/get?format=src"
                      alt="cat pic"
                      on:load={loaded}
                    />
                    {#if !imageLoaded}
                      <progress value={$progress} />
                    {/if}
                  </div>
                  <section class="field-row" style="justify-content: flex-end">
                    <button
                      on:click={() => {
                        location.reload();
                      }}>Random</button
                    >
                  </section>
                </article>
                <article role="tabpanel" hidden id="up-tab">
                  <h3>More...</h3>
                </article>
              </section>
            </div>
            <div class="status-bar">
              <p class="status-bar-field">—ฅ/ᐠ. ̫ .ᐟ\ฅ —</p>
              <p class="status-bar-field">Much Wow</p>
              <p class="status-bar-field">ก₍⸍⸌̣ʷ̣̫⸍̣⸌₎ค</p>
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
  img {
    max-width: 100%;
    min-width: 80%;
  }

  .window-size {
    min-width: 20vw;
  }
</style>
