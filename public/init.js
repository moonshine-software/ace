document.addEventListener('alpine:init', () => {
  Alpine.data('ace', (language = 'javascript', options = {}) => ({
    editor: null,

    init() {
      const textarea = this.$root.querySelector('textarea');

      this.editor = ace.edit(
        this.$root.querySelector('.ace_editor'),
        options
      );

      this.editor.session.setMode("ace/mode/" + language);
      this.editor.setTheme(this.getTheme());

      this.editor.session.on('change', () => textarea.value = this.editor.getValue());

      if (this.$el?.readonly || this.$el?.disabled) {
        this.editor.readonly()
      }

      window.addEventListener('darkMode:toggle', () => this.editor.setTheme(this.getTheme()));
    },

    getTheme() {
      return Alpine.store('darkMode').on
        ? "ace/theme/tomorrow_night_blue"
        : "ace/theme/chrome"
    }
  }))
})
