import { forwardRef, useEffect, useRef } from 'react';

export default forwardRef(function TextArea({
  value = '',
  rows = 4,
  cols = 50,
  className = '',
  isFocused = false,
  ...props
}, ref) {
  const textarea = ref ? ref : useRef();

  useEffect(() => {
    if (isFocused) {
      textarea.current.focus();
    }
  }, [isFocused]);

  return (
    <textarea
      {...props}
      value={value}
      rows={rows}
      cols={cols}
      className={
        'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' +
        className
      }
      ref={textarea}
    />
  );
});
