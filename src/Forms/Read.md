# TextInput Class Documentation

The `TextInput` class is a subclass of the `Field` class and is used to represent a text input field in a form.

## Class Properties

### `type` property

- **Type**: `string|Closure|null`
- **Default value**: `"text"`

The `type` property represents the type attribute of the `<input>` element. It can be a string or a closure that returns
a string. The default value is `"text"`.

### `minimum` property

- **Type**: `int|Closure|null`
- **Default value**: `null`

The `minimum` property represents the minimum length allowed for the input value. It can be an integer or a closure that
returns an integer. The default value is `null`.

### `autofocus` property

- **Type**: `Closure|bool`
- **Default value**: `true`

The `autofocus` property represents whether the input field should automatically receive focus when the page loads. It
can be a closure that returns a boolean or a boolean value. The default value is `true`.

### `maxValue` property

- **Type**: `mixed`
- **Default value**: `null`

The `maxValue` property represents the maximum value allowed for the input field. It can be any value. The default value
is `null`.

### `pattern` property

- **Type**: `string|Closure|null`
- **Default value**: `null`

The `pattern` property represents a regular expression pattern that the input value must match. It can be a string or a
closure that returns a string. The default value is `null`.

### `helpText` property

- **Type**: `string|Closure|null`
- **Default value**: `null`

The `helpText` property represents the help text that is displayed below the input field. It can be a string or a
closure that returns a string. The default value is `null`.

### `step` property

- **Type**: `int|float|string|Closure|null`
- **Default value**: `null`

The `step` property represents the increment and decrement interval for numeric input fields. It can be an integer,
float, string, or a closure that returns one of these types. The default value is `null`.

### `isReadOnly` property

- **Type**: `bool|Closure`
- **Default value**: `false`

The `isReadOnly` property represents whether the input field should be read-only. It can be a closure that returns a
boolean or a boolean value. The default value is `false`.

### `autocomplete` property

- **Type**: `bool|Closure`
- **Default value**: `false`

The `autocomplete` property represents whether the input field should enable autocomplete. It can be a closure that
returns a boolean or a boolean value. The default value is `false`.

### `prefix` property

- **Type**: `string|Closure|null`
- **Default value**: `null`

The `prefix` property represents the prefix that is displayed before the input field. It can be a string or a closure
that returns a string. The default value is `null`.

### `position` property

- **Type**: `string|Closure|null`
- **Default value**: `null`

The `position` property represents the position of the prefix relative to the input field. It can be a string or a
closure that returns a string. The default value is `null`.

### `view` property

- **Type**: `string`
- **Default value**: `"ballstack::forms.components.input"`

The `view` property represents the view template that is used to render the input field. It is a string that specifies
the path to the view file. The default value is `"ballstack::forms.components.input"`.

## Class Methods

### `getUniqueId` method

- **Return type**: `string`

The `getUniqueId` method returns a unique identifier for the input field. It evaluates the `uniqueId` property using
the `evaluate` method inherited from the `Field` class.

### `type` method

- **Parameters**: `string|Closure $type`
- **Return type**: `self`

The `type` method sets the value of the `type` property and returns the current instance of the `TextInput` class. It
allows you to specify the type attribute of the input field.

### `getType` method

- **Return type**: `string|Closure|null`

The `getType` method returns the value of the `type` property. If the `type` property is not set, it returns the default
value `"text"`. It evaluates the `type` property using the `evaluate` method inherited from the `Field` class.

### `minLength` method

- **Parameters**: `int $minimum`
- **Return type**: `static`

The `minLength` method sets the value of the `minimum` property and returns the current instance of the `TextInput`
class. It allows you to specify the minimum length allowed for the input value.

### `getMinLength` method

- **Return type**: `int|Closure|null`

The `getMinLength` method returns the value of the `minimum` property. If the `minimum` property is not set, it
returns `null`. It evaluates the `minimum` property using the `evaluate` method inherited from the `Field` class.

### `autofocus` method

- **Parameters**: `bool|Closure $autofocus = true`
- **Return type**: `static`

The `autofocus` method sets the value of the `autofocus` property and returns the current instance of the `TextInput`
class. It allows you to specify whether the input field should automatically receive focus.

### `getAutofocus` method

- **Return type**: `bool`

The `getAutofocus` method returns the value of the `autofocus` property. It evaluates the `autofocus` property using
the `evaluate` method inherited from the `Field` class.

### `maxLength` method

- **Parameters**: `int $maximum`
- **Return type**: `static`

The `maxLength` method sets the value of the `maxValue` property and returns the current instance of the `TextInput`
class. It allows you to specify the maximum value allowed for the input field.

### `getMaxLength` method

- **Return type**: `int|Closure|null`

The `getMaxLength` method returns the value of the `maxValue` property. If the `maxValue` property is not set, it
returns `null`. It evaluates the `maxValue` property using the `evaluate` method inherited from the `Field` class.

### `pattern` method

- **Parameters**: `string $pattern`
- **Return type**: `static`

The `pattern` method sets the value of the `pattern` property and returns the current instance of the `TextInput` class.
It allows you to specify a regular expression pattern that the input value must match.

### `getPattern` method

- **Return type**: `string|Closure|null`

The `getPattern` method returns the value of the `pattern` property. If the `pattern` property is not set, it
returns `null`. It evaluates the `pattern` property using the `evaluate` method inherited from the `Field` class.

### `helpText` method

- **Parameters**: `string $helpText`
- **Return type**: `static`

The `helpText` method sets the value of the `helpText` property and returns the current instance of the `TextInput`
class. It allows you to specify the help text that is displayed below the input field.

### `getHelpText` method

- **Return type**: `string|Closure|null`

The `getHelpText` method returns the value of the `helpText` property. It evaluates the `helpText` property using
the `evaluate` method inherited from the `Field` class.

### `readOnly` method

- **Parameters**: `bool $readOnly = true`
- **Return type**: `static`

The `readOnly` method sets the value of the `isReadOnly` property and returns the current instance of the `TextInput`
class. It allows you to specify whether the input field should be read-only.

### `getReadOnly` method

- **Return type**: `bool`

The `getReadOnly` method returns the value of the `isReadOnly` property. It evaluates the `isReadOnly` property using
the `evaluate` method inherited from the `Field` class.

### `step` method

- **Parameters**: `int|float|string|Closure|null $interval`
- **Return type**: `static`

The `step` method sets the value of the `step` property and returns the current instance of the `TextInput` class. It
allows you to specify the increment and decrement interval for numeric input fields.

### `getStep` method

- **Return type**: `int|float|string|null`

The `getStep` method returns the value of the `step` property. If the `step` property is not set, it returns `null`. It
evaluates the `step` property using the `evaluate` method inherited from the `Field` class.

### `autocomplete` method

- **Parameters**: `bool|Closure $autocomplete = true`
- **Return type**: `static`

The `autocomplete` method sets the value of the `autocomplete` property and returns the current instance of
the `TextInput` class. It allows you to specify whether the input field should enable autocomplete.

### `getAutocomplete` method

- **Return type**: `bool`

The `getAutocomplete` method returns the value of the `autocomplete` property. It evaluates the `autocomplete` property
using the `evaluate` method inherited from the `Field` class.

### `email` method

- **Return type**: `static`

The `email` method sets the `type` property to `"email"` and returns the current instance of the `TextInput` class. It
is a convenience method for setting the input type to email.

### `numeric` method

- **Return type**: `static`

The `numeric` method sets the `type` property to `"number"` and returns the current instance of the `TextInput` class.
It is a convenience method for setting the input type to number.

### `password` method

- **Return type**: `static`

The `password` method sets the `type` property to `"password"` and returns the current instance of the `TextInput`
class. It is a convenience method for setting the input type to password.

### `tel` method

- **Return type**: `static`

The `tel` method sets the `type` property to `"tel"` and returns the current instance of the `TextInput` class. It is a
convenience method for setting the input type to telephone.

### `url` method

- **Return type**: `static`

The `url` method sets the `type` property to `"url"` and returns the current instance of the `TextInput` class. It is a
convenience method for setting the input type to URL.

### `prefix` method

- **Parameters**: `string|Closure|null $prefix`
- **Return type**: `static`

The `prefix` method sets the value of the `prefix` property and returns the current instance of the `TextInput` class.
It allows you to specify the prefix that is displayed before the input field.

### `getPrefix` method

- **Return type**: `string|null`

The `getPrefix` method returns the value of the `prefix` property. It evaluates the `prefix` property using
the `evaluate` method inherited from the `Field` class.

### `position` method

- **Parameters**: `string|Closure|null $position = 'left'`
- **Return type**: `static`

The `position` method sets the value of the `position` property and returns the current instance of the `TextInput`
class. It allows you to specify the position of the prefix relative to the input field.

### `getPosition` method

- **Return type**: `string|null`

The `getPosition` method returns the value of the `position` property. It evaluates the `position` property using
the `evaluate` method inherited from the `Field` class.
