<script>
  export let IsXpStyle = true;
  export let IsVisisble = false;

  function close() {
    IsVisisble = false;
  }
</script>

{#if IsVisisble}
<div class="backdrop">

</div>
<div class="modal">
    <div class="window contents window-size">
      <div class="title-bar">
        <div class="title-bar-text">Change Version</div>

        <div class="title-bar-controls">
          <button aria-label="Minimize" />
          <button aria-label="Maximize" />
          <button on:click={close} aria-label="Close" />
        </div>
      </div>
      <div class="window-body">
        <p>
          Do you want to {IsXpStyle
            ? "downgrade to Windows 98"
            : "upgrade to Windows XP"} ?
        </p>
        <section class="field-row" style="justify-content: flex-end">
          <button on:click>Yes</button>
          <button on:click={close}>No</button>
        </section>
      </div>
    </div>
  </div>
  {/if}

<style>

  .window-size {
    margin: 32px;
    width: 250px
  }
  .modal {
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;

    /* allow click-through to backdrop */
    pointer-events: none;
  }

  .contents {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    pointer-events: auto;
  }

  .backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background: rgba(0,0,0,0.25)
  }
</style>
